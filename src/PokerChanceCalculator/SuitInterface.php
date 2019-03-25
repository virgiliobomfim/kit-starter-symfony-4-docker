<?php

namespace App\PokerChanceCalculator;

interface SuitInterface
{
    const CLUBS = 'C';
    const DIAMONDS = 'D';
    const HEARTS = 'H';
    const SPADES = 'S';

    public function __toString();
}