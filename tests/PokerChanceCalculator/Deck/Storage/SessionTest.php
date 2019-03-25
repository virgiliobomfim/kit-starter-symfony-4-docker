<?php

namespace App\Tests\PokerChanceCalculator\Deck\Storage;

use App\PokerChanceCalculator\Deck\Storage\Session;
use App\PokerChanceCalculator\DeckInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    /**
     * @var SessionInterface
     */
    protected $sessionMock;

    /**
     * @var Session
     */
    protected $model;

    public function setUp()
    {
        $this->sessionMock = $this->createMock(SessionInterface::class);

        $this->model = new Session($this->sessionMock);
    }

    public function testStore()
    {
        $deckMock = $this->createMock(DeckInterface::class);

        $this->sessionMock->expects($this->once())
            ->method('set')
            ->with(Session::DECK, $deckMock);

        $this->model->store($deckMock);
    }

    public function testPurge()
    {
        $this->sessionMock->expects($this->once())
            ->method('remove')
            ->with(Session::DECK);

        $this->model->purge();
    }
}