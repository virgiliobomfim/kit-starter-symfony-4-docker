<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Joker implements RankInterface
{
    public function __toString()
    {
        return RankInterface::JOKER;
    }
}