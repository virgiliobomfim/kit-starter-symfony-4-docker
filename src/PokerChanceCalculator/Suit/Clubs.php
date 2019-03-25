<?php
namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

class Clubs implements SuitInterface
{
    public function __toString()
    {
        return SuitInterface::CLUBS;
    }
}