<?php

namespace App\PokerChanceCalculator\Deck\Source;

use App\PokerChanceCalculator\Deck\ProviderInterface;
use App\PokerChanceCalculator\DeckInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Session implements ProviderInterface
{
    const DECK = 'deck';
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function hasData() : bool
    {
        return $this->session->has(self::DECK);
    }

    public function getData() : DeckInterface
    {
        return $this->session->get(self::DECK);
    }
}