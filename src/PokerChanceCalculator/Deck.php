<?php

namespace App\PokerChanceCalculator;

use App\PokerChanceCalculator\CardInterface;

class Deck implements DeckInterface
{
    private $cards = [];

    public function __construct(array $cards = [])
    {
        foreach ($cards as $card) {
            $this->addCard($card);
        };
    }

    private function addCard(CardInterface $card)
    {
        $this->cards[(string) $card] = $card;
    }

    public function draw(): CardInterface
    {
        return array_shift($this->cards);
    }

    public function getRemaining() : int
    {
        return count($this->cards);
    }

    public function shuffleCards() : void
    {
        shuffle($this->cards);
    }

    public function getCards() : array
    {
        return $this->cards;
    }
}