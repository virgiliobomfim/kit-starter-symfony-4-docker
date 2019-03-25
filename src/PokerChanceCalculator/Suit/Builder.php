<?php

namespace App\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;

class Builder implements BuilderInterface
{
    /**
     * @var array
     */
    private $availableSuits = [];

    public function __construct(array $availableSuits)
    {
        $this->availableSuits = $availableSuits;
    }

    public function build(string $buildSubject = '') : SuitInterface
    {
        if (!array_key_exists($buildSubject, $this->availableSuits)) {
            throw new \UnexpectedValueException("'{$buildSubject} is not a valid suit.");
        }

        return $this->availableSuits[$buildSubject];
    }
}