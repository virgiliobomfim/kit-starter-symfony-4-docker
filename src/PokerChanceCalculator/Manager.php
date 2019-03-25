<?php

namespace App\PokerChanceCalculator;

use App\PokerChanceCalculator\Card\BuilderInterface as CardBuilderInterface;
use App\PokerChanceCalculator\Deck\{ProviderInterface as DeckProviderInterface,
                                    StorageInterface as DeckStorageInterface};
use App\PokerChanceCalculator\Suit\BuilderInterface as SuitBuilderInterface;
use App\PokerChanceCalculator\Rank\BuilderInterface as RankBuilderInterface;

class Manager implements ManagerInterface
{
    /**
     * @var CardBuilderInterface
     */
    private $cardBuilder;

    /**
     * @var DeckProviderInterface
     */
    private $deckProvider;

    /**
     * @var DeckProviderInterface
     */
    private $deckStorage;

    /**
     * @var RankBuilderInterface
     */
    private $rankBuilder;

    /**
     * @var SuitBuilderInterface
     */
    private $suitBuilder;

    /**
     * @var CalculatorInterface
     */
    private $calculator;

    public function __construct(
        CardBuilderInterface $cardBuilder,
        DeckProviderInterface $deckProvider,
        DeckStorageInterface $deckStorage,
        RankBuilderInterface $rankBuilder,
        SuitBuilderInterface $suitBuilder,
        CalculatorInterface $calculator
    ) {
        $this->cardBuilder = $cardBuilder;
        $this->deckProvider = $deckProvider;
        $this->deckStorage = $deckStorage;
        $this->rankBuilder = $rankBuilder;
        $this->suitBuilder = $suitBuilder;
        $this->calculator = $calculator;
    }

    public function getProbability(string $userSuit, string $userRank) : float
    {
        $chosenCard = $this->getChosenCard($userSuit, $userRank);
        $deck = $this->getDeck();

        return $this->calculator->getCardProbability($deck, $chosenCard);
    }

    public function getRemainingCards() : int
    {
        return $this->getDeck()->getRemaining();
    }

    public function drawCard() : CardInterface
    {
        $deck = $this->getDeck();

        if (!$deck->getRemaining()) {
            throw new \Exception("Deck has no remaining cards.");
        }

        $card = $deck->draw();

        $this->storeDeck($deck);

        return $card;
    }

    public function resetDeck() : void
    {
        $this->deckStorage->purge();
    }

    public function getCards() : array
    {
        return $this->getDeck()->getCards();
    }

    private function storeDeck(DeckInterface $deck) : void
    {
        $this->deckStorage->store($deck);
    }

    private function getChosenCard(string $userSuit, string $userRank): CardInterface
    {
        $suit = $this->suitBuilder->build($userSuit);
        $rank = $this->rankBuilder->build($userRank);

        return $this->cardBuilder->build([
            CardBuilderInterface::SUIT => $suit,
            CardBuilderInterface::RANK => $rank
        ]);
    }

    private function getDeck() : DeckInterface
    {
        return $this->deckProvider->getData();
    }
}