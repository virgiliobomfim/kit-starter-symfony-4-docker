<?php

namespace App\PokerChanceCalculator;

class Card implements CardInterface
{
    /**
     * @var SuitInterface;
     */
    private $suit;

    /**
     * @var RankInterface;
     */
    private $rank;

    public function __construct(SuitInterface $suit, RankInterface $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function __toString()
    {
        return (string) $this->suit . (string) $this->rank;
    }

    public function getSuit() : SuitInterface
    {
        return $this->suit;
    }

    public function getRank() : RankInterface
    {
        return $this->rank;
    }
}