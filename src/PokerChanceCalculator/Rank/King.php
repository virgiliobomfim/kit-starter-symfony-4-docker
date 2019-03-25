<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class King implements RankInterface
{
    public function __toString()
    {
        return RankInterface::KING;
    }
}