<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Six implements RankInterface
{
    public function __toString()
    {
        return RankInterface::SIX;
    }
}