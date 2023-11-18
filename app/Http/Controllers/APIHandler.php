<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Auth;
use DB;
use Validator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\DomCrawler\Crawler;


class APIHandler extends Controller
{

    public function processEntry(Request $request)
    {
        $context = $request->context;

        try {
            $word = $this->lemmatize($request->word)[0];
        } catch (\Throwable $th) {
            return response()->json([
                'meanings' => [],
                'ai' => [],
                'error' => 'لم يتم العثور على أصل الكلمة المطلوبة'
            ]);
        }

        $entries = $this->exactSearch($word);

        $meanings = array();
        foreach ($entries as $entry) {
            foreach ($entry['senses'] as $sense) {
                foreach ($sense['definition']['textRepresentations'] as $textRepresentation) {
                    $meanings[] = $textRepresentation['form'];
                }
            }
        }

        if (count($meanings) === 0) {
            return response()->json([
                'meanings' => [],
                'ai' => [],
                'error' => 'لم يتم العثور على الكلمة في معجم الرياض.'
            ]);
        }

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You will be provided with a word in arabic, and some of its meanings labeled by number, and a text which contains that word.
return json as an answer in the following format:
{
    //an analysis of how close the meanings
    analysis: {
        //the number of the provided meaning
        meaningNumber: number;
        //the percentage of how close this meaning is to the provided context
        percentage: number;
        //a brief explanation in arabic
        explanation: string;
    }[];
    //suggest a new meaning (different from the provided meanings) for the word in the provided context (make sure the suggested meaning is indeed a meaning of the word in arabic)
    suggestion: {
        //the suggested meaning in arabic
        meaning: string;
        //a brief explanation of the suggestion in arabic
        explanation: string;
    };
    //using the exact same provided word, reformat the provided context (keep the same meaning but rephrase it and ensure the word is used unaltered)
    reformattedContext: string;
}"
                ],
                [
                    'role' => 'user',
                    'content' => "
                            word: $word

                            meanings: [\"" . implode('","', $meanings) . "\"]

                            context: $context
                            "
                ],
            ],
        ]);

        $ai = json_decode($result->choices[0]->message->content);

        return response()->json([
            'context' => $request->context,
            'word' => $request->word,
            'lemma' => $word,
            'meanings' => $meanings,
            'ai' => $ai,
            'error' => null
        ]);
    }

    public function getEntry(Request $request)
    {
        $word = $request->word;

        if ($request->lemma == 1)
            $word = $this->lemmatize($request->word)[0];

        $records = $this->exactSearch($word);
        return response()->json($records);
    }

    public function getLemma(Request $request)
    {
        return $this->lemmatize($request->word);
    }


    /* Used for test purposes to compare results & lemmatization */
    public function summary(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://dictionary.ksaa.gov.sa/',
        ]);

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/119.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip, deflate, br',
            'DNT' => '1',
            'Connection' => 'keep-alive',
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'none',
            'Sec-Fetch-User' => '?1',
            'Sec-GPC' => '1',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'no-cache',
        ];

        $response = $client->request('GET', '/result/' . $request->word, [
            'headers' => $headers,
        ]);


        $body = $response->getBody();
        $html = $body->getContents();

        $crawler = new Crawler($html);

        $scriptContent = $crawler->filter('script#__NEXT_DATA__')->text();

        return response()->json(['data' => json_decode(html_entity_decode($scriptContent, ENT_NOQUOTES, 'UTF-8'))]);
    }

    /*****************************************************************
     *  Helpers & API Callers
     *****************************************************************/

    // The context is hashed in md5
    function getCachedResponse($lemma, $hash)
    {
        return false;
    }

    // maybe add a pos checking if verbs
    public function lemmatize($text)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://farasa.qcri.org/lemmatization/analyze/', [
            'form_params' => [
                'text' => $text,
                'task' => 'lemmatization',
                'API_KEY' => env('FARASA_API_KEY')
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            $output = explode(" ", $result["text"]);
            return $output;
        } else {
            echo "Error: " . $response->getStatusCode();
            return [];
        }
    }

    // Keep only the arabic text and remove diactritics and non standard letters
    function removeDiactritics($text)
    {
        return preg_replace('/[^ء-ي]/u', '', $text);
    }

    public function exactSearch($keyword)
    {

        $client = new Client();

        try {
            $response = $client->request('GET', 'https://siwar.ksaa.gov.sa/api/alriyadh/exact-search', [
                'query' => [
                    'query' => $keyword,
                ],
                'headers' => [
                    'apikey' => env('SIWAR_API_KEY')
                ]
            ]);

            // Check if the status code is 200
            if ($response->getStatusCode() == 200) {
                $records = $response->getBody()->getContents();
                return json_decode($records, true);
            } else {
                //echo "Error: " . $response->getStatusCode();
            }
        } catch (RequestException $e) {
            // This will catch all exceptions
            //echo $e->getMessage();
        }

        return [];
    }
}
