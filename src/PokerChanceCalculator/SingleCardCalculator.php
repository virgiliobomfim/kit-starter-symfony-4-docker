<?php

namespace App\PokerChanceCalculator;

class SingleCardCalculator implements CalculatorInterface
{
    public function getCardProbability(DeckInterface $deck, CardInterface $card) : float
    {
        $totalCards = $deck->getRemaining();
        return 1 / $totalCards;
    }
}