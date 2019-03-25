<?php

namespace App\Test\PokerChanceCalculator;

use App\PokerChanceCalculator\{Card ,CardInterface, SuitInterface,
                                                    RankInterface};

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * @var SuitInterface
     */
    protected $suitMock;
    /**
     * @var RankInterface
     */
    protected $rankMock;
    /**
     * @var Card
     */
    protected $model;

    public function setUp()
    {
        $this->suitMock = $this->createMock(SuitInterface::class);

        $this->rankMock = $this->createMock(RankInterface::class);

        $this->model = new Card(
            $this->suitMock,
            $this->rankMock
        );
    }

    public function testGetSuit()
    {
        $this->assertSame($this->suitMock, $this->model->getSuit());
    }

    public function testGetRank()
    {
        $this->assertSame($this->rankMock, $this->model->getRank());
    }

    public function testToString()
    {
        $suit = 'S';
        $rank = 'A';

        $this->suitMock->expects($this->once())
            ->method('__toString')
            ->willReturn($suit);

        $this->rankMock->expects($this->once())
            ->method('__toString')
            ->willReturn($rank);

        $result = $this->model->__toString();

        $this->assertEquals($suit.$rank, $result);
    }
}