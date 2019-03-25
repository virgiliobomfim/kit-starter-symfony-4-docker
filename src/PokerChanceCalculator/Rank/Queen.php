<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Queen implements RankInterface
{
    public function __toString()
    {
        return RankInterface::QUEEN;
    }
}