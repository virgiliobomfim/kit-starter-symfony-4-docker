<?php

namespace App\PokerChanceCalculator\Deck;

use App\PokerChanceCalculator\DeckInterface;

interface BuilderInterface
{
    const SUITS = 'suits';
    const RANKS = 'ranks';

    public function build(array $buildSubject = []) : DeckInterface;
}