<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Eight implements RankInterface
{
    public function __toString()
    {
        return RankInterface::EIGHT;
    }
}