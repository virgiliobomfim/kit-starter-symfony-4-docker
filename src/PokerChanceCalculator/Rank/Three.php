<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Three implements RankInterface
{
    public function __toString()
    {
        return RankInterface::THREE;
    }
}