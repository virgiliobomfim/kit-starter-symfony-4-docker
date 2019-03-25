<?php

namespace App\PokerChanceCalculator;

interface DeckInterface
{
    public function shuffleCards() : void;

    public function draw(): CardInterface;

    public function getRemaining(): int;

    public function getCards() : array;
}