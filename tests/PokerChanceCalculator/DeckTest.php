<?php

namespace App\Tests\PokerChanceCalculator;

use App\PokerChanceCalculator\{CardInterface, Deck, Deckinterface};

use PHPUnit\Framework\TestCase;

class DeckTest extends TestCase
{
    /**
     * @var Deck
     */
    protected $model;


    public function setUp()
    {
        $this->model = new Deck([
            $this->createMock(CardInterface::class),
            $this->createMock(CardInterface::class),
            $this->createMock(CardInterface::class),
            $this->createMock(CardInterface::class)
        ]);
    }

    public function testShoudlReduceRemainingOnDraw()
    {
        $remainingBefore = $this->model->getRemaining();

        $this->model->draw();

        $remainingAfter = $this->model->getRemaining();

        $this->assertTrue($remainingBefore > $remainingAfter);
    }
}