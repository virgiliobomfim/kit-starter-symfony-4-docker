<?php
namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

class Hearts implements SuitInterface
{
    public function __toString()
    {
        return SuitInterface::HEARTS;
    }
}