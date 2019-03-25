<?php

namespace App\PokerChanceCalculator\Deck;

use App\PokerChanceCalculator\DeckInterface;
use App\PokerChanceCalculator\Deck;
use App\PokerChanceCalculator\SuitInterface;
use App\PokerChanceCalculator\Card\BuilderInterface as CardBuilderInterface;

class Builder implements BuilderInterface
{
    /**
     = @var CardBuilderInterface
     */
    private $cardBuilder;

    public function __construct(CardBuilderInterface $cardBuilder)
    {
        $this->cardBuilder = $cardBuilder;
    }

    public function build(array $buildSubject = []) : DeckInterface
    {
        if (empty($buildSubject[BuilderInterface::SUITS])) {
            throw new \Exception('Please provide suits.');
        }

        if (empty($buildSubject[BuilderInterface::RANKS])) {
            throw new \Exception('Please provide ranks.');
        }

        $cards = [];
        foreach ($buildSubject[BuilderInterface::SUITS] as $suit) {
            $cards = array_merge($cards, $this->getSuitCards($suit,
                $buildSubject[BuilderInterface::RANKS]));
        }

        return new Deck($cards);
    }

    private function getSuitCards(SuitInterface $suit, $ranks)
    {
        $cards = [];
        foreach ($ranks as $rank) {
            $cards[] = $this->cardBuilder->build([
                CardBuilderInterface::SUIT => $suit,
                CardBuilderInterface::RANK => $rank
            ]);
        }

        return $cards;
    }
}