<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\DomCrawler\Crawler;


class APIHandler extends Controller
{
    public function processEntry(Request $request)
    {
        $context = $request->context;
        $extra = $request->extra == 1;

        $response = [
            'context' => $context,
            'word' => $request->word,
            'extra' => $extra,
            'error' => null,
        ];

        try {
            $word = $this->lemmatize($request->word)[0];

            $response['lemma'] = $word;
        } catch (\Throwable $th) {
            $response['error'] = 'لم يتم العثور على أصل الكلمة المطلوبة';
            $entry = \App\Models\Entry::firstOrCreate(
                ['context_hash' => md5($context)],
                [
                    'lemma' => $word,
                    'context_data' => $response,
                ]
            );
            return response()->json([
                'context' => $context,
                'word' => $request->word,
                'lemma' => "",
                'extra' => $extra,
                'meanings' => [],
                'ai' => [],
                'error' => 'لم يتم العثور على أصل الكلمة المطلوبة'
            ]);
        }

        // if enrty exists in the database, return it
        $entry = \App\Models\Entry::where('context_hash', md5($context))->first();
        if ($entry) {
            $context_data = $entry->context_data;
            return response()->json($context_data);
        }

        try {
            $entries = $this->exactSearch($word);

            $meanings = array();
            foreach ($entries as $entry) {
                foreach ($entry['senses'] as $sense) {
                    foreach ($sense['definition']['textRepresentations'] as $textRepresentation) {
                        $meanings[] = $textRepresentation['form'];
                    }
                }
            }

            // filter only $meanings that are not empty
            $meanings = array_filter($meanings);

            if (count($meanings) === 0) {
                throw new \Exception("No meanings found for the word $word");
            }

            $response['meanings'] = $meanings;
        } catch (\Throwable $th) {
            $response['error'] = 'لم يتم العثور على الكلمة في معجم الرياض.';
            $entry = \App\Models\Entry::firstOrCreate(
                ['context_hash' => md5($context)],
                [
                    'lemma' => $word,
                    'context_data' => $response
                ]
            );
            return response()->json([
                'context' => $context,
                'word' => $request->word,
                'lemma' => $word,
                'extra' => $extra,
                'meanings' => [],
                'ai' => [],
                'error' => 'لم يتم العثور على الكلمة في معجم الرياض.'
            ]);
        }

        $result = OpenAI::chat()->create([
            'model' => 'gpt-4-1106-preview',
            'messages' => [
                [
                    'role' => 'system',
                    'content' =>
                    "As a linguistic expert, leverage your expertise to analyze the Arabic word enclosed between {\$& and &\$} within the provided contextual text. Return the number corresponding to the closest labeled meaning for the enclosed word in that context. Return a JSON response in the following format:

                        ```json
                        {
                            \"analysis\": [
                                // array of meanings
                                {
                                    \"meaningNumber\": meaningNumber,
                                    \"percentage\": \"percentage in number of how close the meaning is to the provided context for the enclosed word\",
                                    " . (!$extra ? "" : "
                                    \"explanation\": \"A very brief explanation of the analysis. the explanation should be in Arabic\"
                                    ") . "
                                }
                            ],
                            " . (!$extra ? "" : "
                            \"suggestion\": {
                                \"meaning\": \"Suggested meaning in Arabic based on linguistic expertise\",
                                \"explanation\": \"Detailed linguistic reasoning behind the suggestion. the explanation should be in Arabic\"
                            },
                            \"reformattedContext\": \"Reformulated context maintaining linguistic precision and ensuring the word's unaltered use\"
                            ") . "
                        }
                        ```
                        "
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

        $ai = json_decode(str_replace(["```json\n", "\n```"], "", $result->choices[0]->message->content));

        $response['ai'] = $ai;

        // create a new entry in the database if it doesn't exist
        if ($extra) {
            $entry = \App\Models\Entry::firstOrCreate(
                ['context_hash' => md5($context)],
                [
                    'lemma' => $word,
                    'context_data' => $response,
                    'related_entries' => $entries
                ]
            );
        }

        return response()->json($response);
    }

    /*****************************************************************
     *  Helpers & API Callers
     *****************************************************************/

    public function getLemmatize(Request $request)
    {
        return response()->json($this->lemmatize($request->text));
    }


    public function getPOSTag(Request $request)
    {
        return response()->json($this->postag($request->text));
    }

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

    // POS tagging, e.g.: checking if verb
    public function postag($text)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://farasa.qcri.org/callQats/', [
            'form_params' => [
                'text' => $text,
                'task' => '6',
                'normalized' => true,
                'API_KEY' => env('FARASA_API_KEY')
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            //$output = explode(" ", $result["text"]);
            return $result;
        } else {
            echo "Error: " . $response->getStatusCode();
            return [];
        }
    }


    /**
     * Perform an exact search using the Siwar API.
     *
     * @param string $keyword The keyword to search for.
     * @return array The search results.
     * @throws \Exception When there is an error response or a request exception.
     */
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

            // Check if the status code is 200 then return the results
            if ($response->getStatusCode() == 200) {
                $records = $response->getBody()->getContents();
                return json_decode($records, true);
            } else {
                // Handle error response
                throw new \Exception("Error: " . $response->getStatusCode());
            }
        } catch (RequestException $e) {
            // Handle request exception
            throw new \Exception($e->getMessage());
        }
    }
}
