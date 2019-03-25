<?php

namespace App\PokerChanceCalculator;

interface CalculatorInterface
{
    public function getCardProbability(DeckInterface $deck, CardInterface $card) : float;
}