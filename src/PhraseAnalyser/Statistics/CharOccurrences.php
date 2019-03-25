<?php

namespace App\PhraseAnalyser\Statistics;

class CharOccurrences implements ProviderInterface
{
    public function get(string $phrase = '') : array
    {
        $uniqueChars = array_unique(str_split($phrase));
        $chars = [];

        foreach ($uniqueChars as $char) {
            $charOccurrences = substr_count($phrase, $char);
            $chars[$char] = [
                ProviderInterface::OCCURRENCES => $charOccurrences
            ];
        }

        return $chars;
    }
}