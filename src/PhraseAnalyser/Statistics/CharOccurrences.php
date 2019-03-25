<?php

namespace App\PhraseAnalyser\Statistics;

class CharOccurrences implements ProviderInterface
{
    public function get(string $phrase = '') : array
    {
        $chars = array_unique(str_split($phrase));
        $charCount = [];

        foreach ($chars as $char) {
            $charCount[$char] = ['occurrences' => substr_count($phrase, $char)];
        }

        return $charCount;
    }
}