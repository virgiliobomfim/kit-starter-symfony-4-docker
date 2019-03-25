<?php

namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(string $buildSubject = '') : SuitInterface;
}