<?php

namespace App\PokerChanceCalculator\Card;

use App\PokerChanceCalculator\Card;
use App\PokerChanceCalculator\CardInterface;

class Builder implements BuilderInterface
{
    public function build(array $buildSubject = []) : CardInterface
    {
        if (empty($buildSubject[BuilderInterface::SUIT])) {
            throw new \Exception('Please provide suit.');
        }

        if (empty($buildSubject[BuilderInterface::RANK])) {
            throw new \Exception('Please provide rank.');
        }

        return new Card($buildSubject[BuilderInterface::SUIT],
            $buildSubject[BuilderInterface::RANK]);
    }
}