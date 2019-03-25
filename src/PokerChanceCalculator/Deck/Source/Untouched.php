<?php

namespace App\PokerChanceCalculator\Deck\Source;

use App\PokerChanceCalculator\Deck\{ProviderInterface, BuilderInterface};
use App\PokerChanceCalculator\DeckInterface;

class Untouched implements ProviderInterface
{
    /**
     * @var BuilderInterface
     */
    private $deckBuilder;

    /**
     * @var SuitInterface[]
     */
    private $suits = [];

    /**
     * @var RankInterface[]
     */
    private $ranks = [];

    public function __construct(
        BuilderInterface $deckBuilder,
        array $suits,
        array $ranks

    ) {
        $this->deckBuilder = $deckBuilder;
        $this->suits = $suits;
        $this->ranks = $ranks;
    }

    public function hasData() : bool
    {
        return true;
    }

    public function getData() : DeckInterface
    {
        $deck = $this->deckBuilder->build([
            BuilderInterface::SUITS => $this->suits,
            BuilderInterface::RANKS => $this->ranks]);
        $deck->shuffleCards();

        return $deck;
    }
}