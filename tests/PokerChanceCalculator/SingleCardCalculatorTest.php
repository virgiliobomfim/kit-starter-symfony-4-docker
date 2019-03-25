<?php

namespace App\Tests\PokerChanceCalculator;

use App\PokerChanceCalculator\{DeckInterface, SingleCardCalculator, CardInterface};

use PHPUnit\Framework\TestCase;

class SingleCardCalculatorTest extends TestCase
{
    /**
     * @var SingleCardCalculator
     */
    protected $model;

    public function setUp()
    {
        $this->model = new SingleCardCalculator;
    }

    public function testGetCardProbability()
    {
        $deckMock = $this->createMock(DeckInterface::class);
        $deckMock->expects($this->once())
            ->method('getRemaining')
            ->willReturn(1);

        $cardMock = $this->createMock(CardInterface::class);

        $result = $this->model->getCardProbability($deckMock, $cardMock);

        $this->assertEquals(1, $result);
    }
}