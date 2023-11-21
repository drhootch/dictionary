<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'context_data' => 'json',
        'related_entries' => 'json',
    ];

    public function getMeaningsAttribute()
    {
        $meanings = $this->context_data['meanings'] ?? [];
        $meaningsArray = [];

        // Append the original position in the string
        foreach ($meanings as $key => $meaning) {
            $filteredArray = array_filter($this->context_data["ai"]['analysis'], function ($item, $key2) use ($key) {
                return ($key == ((int)$item['meaningNumber']) - 1);
            }, ARRAY_FILTER_USE_BOTH);

            $firstElement = null;
            if (!empty($filteredArray)) {
                $firstElement = array_shift($filteredArray);
            }

            $meaningsArray[$key] = [
                "meaning" => $meaning,
                ...($firstElement ?? []),
            ];
        }

        usort($meaningsArray, function ($a, $b) {
            return ($a["percentage"] ?? 0) < ($b["percentage"] ?? 0);
        });
        $meaningsArray[0]["accepted"] = ($meaningsArray[0]["percentage"] ?? 0) >= 50;


        return $meaningsArray;
    }
}
