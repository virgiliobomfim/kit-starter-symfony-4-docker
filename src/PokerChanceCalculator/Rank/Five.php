<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Five implements RankInterface
{
    public function __toString()
    {
        return RankInterface::FIVE;
    }
}