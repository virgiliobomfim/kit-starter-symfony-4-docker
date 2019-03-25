<?php
namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

class Spades implements SuitInterface
{
    public function __toString()
    {
        return SuitInterface::SPADES;
    }
}