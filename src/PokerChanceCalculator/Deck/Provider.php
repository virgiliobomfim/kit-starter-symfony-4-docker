<?php

namespace App\PokerChanceCalculator\Deck;

use App\PokerChanceCalculator\DeckInterface;

class Provider implements ProviderInterface
{
    /**
     * @var ProviderInterface[]
     */
    private $sources = [];

    public function __construct(ProviderInterface ...$sources)
    {
        $this->sources = $sources;
    }
    public function hasData() : bool
    {
        foreach ($this->sources as $source) {
            if ($source->hasData()) {
                return true;
            }
        }

        return false;
    }

    public function getData() : DeckInterface
    {
        $deck = null;
        foreach ($this->sources as $source) {
            if ($source->hasData()) {
                $deck = $source->getData();
                break;
            }
        }

        return $deck;
    }
}