<?php

namespace App\PhraseAnalyser\Statistics;

class MaxDistanceBetweenChars implements ProviderInterface
{
    public function get(string $phrase = '') : array
    {
        $allChars = str_split($phrase);
        $uniqueChars = array_unique($allChars);

        $maxDistances = [];

        foreach ($uniqueChars as $char) {
            $firstOccurrence = strpos($phrase, $char);
            $lastOccurrence = strrpos($phrase, $char);

            $distance = $lastOccurrence - $firstOccurrence;

            if ($distance > 0) {
                $maxDistances[$char] = ['max_distance' => $distance];
            }
        }

        return $maxDistances;
    }
}