<?php

namespace App\Tests\PokerChanceCalculator\Deck\Source;

use App\PokerChanceCalculator\Deck\Source\Untouched;
use App\PokerChanceCalculator\Deck\{ProviderInterface, BuilderInterface};
use App\PokerChanceCalculator\{DeckInterface, RankInterface, SuitInterface};

use PHPUnit\Framework\TestCase;

class UntouchedTest extends TestCase
{
    /**
     * @var array
     */
    protected $ranks;

    /**
     * @var array
     */
    protected $suits;

    /**
     * @var BuilderInterface
     */
    protected $deckBuilderMock;

    /**
     * @var Untouched
     */
    protected $model;

    public function setUp()
    {
        $this->ranks = [
            $this->createMock(RankInterface::class),
            $this->createMock(RankInterface::class),
            $this->createMock(RankInterface::class)
        ];

        $this->suits = [
            $this->createMock(SuitInterface::class),
            $this->createMock(SuitInterface::class)
        ];

        $this->deckBuilderMock = $this->createMock(BuilderInterface::class);

        $this->model = new Untouched(
            $this->deckBuilderMock,
            $this->suits,
            $this->ranks
        );
    }

    public function testGetData()
    {
        $deckMock = $this->createMock(DeckInterface::class);
        $this->deckBuilderMock->expects($this->once())
            ->method('build')
            ->with([
                BuilderInterface::SUITS => $this->suits,
                BuilderInterface::RANKS => $this->ranks
            ])->willReturn($deckMock);

        $result = $this->model->getData();

        $this->assertSame($deckMock, $result);
    }
}