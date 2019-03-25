<?php

namespace App\Tests\PokerChanceCalculator\Rank;

use App\PokerChanceCalculator\RankInterface;
use App\PokerChanceCalculator\Rank\{Builder, BuilderInterface};

use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var array
     */
    protected $availableRanks = [];

    /**
     * @var Builder
     */
    protected $model;

    public function setUp()
    {
        $this->availableRanks = [
            'J' => $this->createMock(RankInterface::class)
        ];

        $this->model = new Builder(
            $this->availableRanks
        );
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage Y is not a valid rank.
     */
    public function testShouldThrowExceptionWhenDisallowedRankIsProvided()
    {
        $rank = 'Y';

        $this->model->build($rank);
    }

    public function testShouldGetRankInterfaceWhenAllowedRankIsProvided()
    {
        $rank = 'J';

        $result = $this->model->build($rank);

        $this->assertTrue($result instanceof RankInterface);
    }
}