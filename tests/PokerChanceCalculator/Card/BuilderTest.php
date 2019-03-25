<?php

namespace App\Tests\PokerChanceCalculator\Card;

use App\PokerChanceCalculator\Card\{Builder, BuilderInterface};
use App\PokerChanceCalculator\{Card, CardInterface, RankInterface,
                                                    SuitInterface};

use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var Builder
     */
    protected $model;

    public function setUp()
    {
        $this->model = new Builder;
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Please provide suit.
     */
    public function testShouldThrowExceptionIfSuitIsNotProvided()
    {
        $buildSubject = [
            BuilderInterface::RANK => $this->createMock(RankInterface::class)
        ];

        $this->model->build($buildSubject);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Please provide rank.
     */
    public function testShouldThrowExceptionIfRankIsNotProvided()
    {
        $buildSubject = [
            BuilderInterface::SUIT => $this->createMock(SuitInterface::class)
        ];

        $this->model->build($buildSubject);
    }

    public function testShouldCreateCardInterface()
    {
        $buildSubject = [
            BuilderInterface::SUIT => $this->createMock(SuitInterface::class),
            BuilderInterface::RANK => $this->createMock(RankInterface::class)
        ];

        $result = $this->model->build($buildSubject);

        $this->assertTrue($result instanceof CardInterface);
    }
}