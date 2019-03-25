<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Jack implements RankInterface
{
    public function __toString()
    {
        return RankInterface::JACK;
    }
}