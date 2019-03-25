<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Nine implements RankInterface
{
    public function __toString()
    {
        return RankInterface::NINE;
    }
}