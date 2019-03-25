<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Two implements RankInterface
{
    public function __toString()
    {
        return RankInterface::TWO;
    }
}