<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Ten implements RankInterface
{
    public function __toString()
    {
        return RankInterface::TEN;
    }
}