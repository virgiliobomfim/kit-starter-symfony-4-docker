<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(string $buildSubject = '') : RankInterface;
}