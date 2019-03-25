<?php

namespace App\PokerChanceCalculator\Deck;

use App\PokerChanceCalculator\DeckInterface;

interface StorageInterface
{
    public function store(DeckInterface $deck) : void;

    public function purge() : void;
}