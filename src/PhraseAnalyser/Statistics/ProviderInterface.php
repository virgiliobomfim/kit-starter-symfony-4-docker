<?php

namespace App\PhraseAnalyser\Statistics;

interface ProviderInterface
{
    public function get(string $phrase = '') : array;
}