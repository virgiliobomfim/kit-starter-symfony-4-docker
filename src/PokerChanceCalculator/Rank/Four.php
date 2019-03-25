<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Four implements RankInterface
{
    public function __toString()
    {
        return RankInterface::FOUR;
    }
}