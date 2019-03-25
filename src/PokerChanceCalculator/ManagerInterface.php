<?php

namespace App\PokerChanceCalculator;

interface ManagerInterface
{
    public function getProbability(string $suit, string $rank) : float;

    public function getRemainingCards() : int;

    public function drawCard() : CardInterface;

    public function resetDeck() : void;

    public function getCards() : array;
}