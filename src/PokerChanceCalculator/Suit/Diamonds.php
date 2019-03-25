<?php
namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

class Diamonds implements SuitInterface
{
    public function __toString()
    {
        return SuitInterface::DIAMONDS;
    }
}