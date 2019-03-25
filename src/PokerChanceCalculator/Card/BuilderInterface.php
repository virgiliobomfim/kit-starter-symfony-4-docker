<?php

namespace App\PokerChanceCalculator\Card;

use App\PokerChanceCalculator\CardInterface;

interface BuilderInterface
{
    const SUIT = 'suit';
    const RANK = 'rank';

    public function build(array $buildSubject = []) : CardInterface;
}