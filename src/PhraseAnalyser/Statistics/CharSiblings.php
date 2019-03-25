<?php

namespace App\PhraseAnalyser\Statistics;

class CharSiblings implements ProviderInterface
{
    public function get(string $phrase = '') : array
    {
        $allChars = str_split($phrase);
        $uniqueChars = array_unique($allChars);
        $siblings = [];

        foreach ($allChars as $index => $char) {
            if ($index > 0) {
                if (!isset($siblings[$char]['before'])) {
                    $siblings[$char]['before'] = [];
                }
                $siblings[$char]['before'][] = $allChars[$index - 1];
                $siblings[$char]['before'] = array_unique($siblings[$char]['before']);
            }

            if ($index < strlen($phrase) -1) {
                if (!isset($siblings[$char]['after'])) {
                    $siblings[$char]['after'] = [];
                }
                $siblings[$char]['after'][] = $allChars[$index + 1];
                $siblings[$char]['after'] = array_unique($siblings[$char]['after']);
            }
        }

        return $siblings;
    }
}