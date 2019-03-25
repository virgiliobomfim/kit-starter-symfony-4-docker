<?php

namespace App\PokerChanceCalculator;

interface RankInterface
{
    const ACE = 'A';
    const TWO = '2';
    const THREE = '3';
    const FOUR = '4';
    const FIVE = '5';
    const SIX = '6';
    const SEVEN = '7';
    const EIGHT = '8';
    const NINE = '9';
    const TEN = '10';
    const JACK = 'J';
    const QUEEN = 'Q';
    const KING = 'K';

    public function __toString();
}