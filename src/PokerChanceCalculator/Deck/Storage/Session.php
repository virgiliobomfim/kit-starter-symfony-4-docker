<?php

namespace App\PokerChanceCalculator\Deck\Storage;

use App\PokerChanceCalculator\Deck\StorageInterface;
use App\PokerChanceCalculator\DeckInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Session implements StorageInterface
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

    public function store(DeckInterface $deck) : void
    {
        $this->session->set(self::DECK, $deck);
    }

    public function purge() : void
    {
        $this->session->remove(self::DECK);
    }
}