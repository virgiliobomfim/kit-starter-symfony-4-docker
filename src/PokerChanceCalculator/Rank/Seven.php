<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Seven implements RankInterface
{
    public function __toString()
    {
        return RankInterface::SEVEN;
    }
}