<?php

namespace App\PhraseAnalyser\Statistics;

interface ProviderInterface
{
    const BEFORE = 'before';
    const AFTER = 'after';
    const MAX_DISTANCE = 'max_distance';
    const OCCURRENCES = 'occurrences';

    public function get(string $phrase = '') : array;
}