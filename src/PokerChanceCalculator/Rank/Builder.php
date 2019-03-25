<?php

namespace App\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;

class Builder implements BuilderInterface
{
    /**
     * @var array
     */
    private $availableRanks = [];

    public function __construct(array $availableRanks)
    {
        $this->availableRanks = $availableRanks;
    }

    public function build(string $buildSubject = '') : RankInterface
    {
        if (!array_key_exists($buildSubject, $this->availableRanks)) {
            throw new \UnexpectedValueException("'{$buildSubject} is not a valid rank.");
        }

        return $this->availableRanks[$buildSubject];
    }
}