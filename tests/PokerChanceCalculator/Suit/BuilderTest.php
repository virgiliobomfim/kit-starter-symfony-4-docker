<?php

namespace App\Tests\PokerChanceCalculator\Suit;

use App\PokerChanceCalculator\SuitInterface;
use App\PokerChanceCalculator\Suit\{Builder, BuilderInterface};

use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var array
     */
    protected $availableSuits = [];

    /**
     * @var Builder
     */
    protected $model;

    public function setUp()
    {
        $this->availableSuits = [
            'S' => $this->createMock(SuitInterface::class)
        ];

        $this->model = new Builder(
            $this->availableSuits
        );
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage Y is not a valid suit.
     */
    public function testShouldThrowExceptionWhenDisallowedSuitIsProvided()
    {
        $suit = 'Y';

        $this->model->build($suit);
    }

    public function testShouldGetSuitInterfaceWhenAllowedSuitIsProvided()
    {
        $suit = 'S';

        $result = $this->model->build($suit);

        $this->assertTrue($result instanceof SuitInterface);
    }
}