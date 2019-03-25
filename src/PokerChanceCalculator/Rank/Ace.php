<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Ace implements RankInterface
{
    public function __toString()
    {
        return RankInterface::ACE;
    }
}