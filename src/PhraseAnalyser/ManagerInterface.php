<?php

namespace App\PhraseAnalyser;

interface ManagerInterface
{
    public function getStatistics(string $phrase = '') : array;
}