<?php

namespace App\PokerChanceCalculator;

interface CardInterface
{
    public function __toString();

    public function getSuit() : SuitInterface;

    public function getRank() : RankInterface;
}