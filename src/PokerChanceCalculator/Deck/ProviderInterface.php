<?php

namespace App\PokerChanceCalculator\Deck;

use App\PokerChanceCalculator\DeckInterface;

interface ProviderInterface
{
    public function hasData() : bool;

    public function getData() : DeckInterface;
}