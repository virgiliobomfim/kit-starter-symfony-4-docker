<?php

namespace App\Tests\PokerChanceCalculator;

use App\PokerChanceCalculator\{CalculatorInterface, Manager, CardInterface,
                                    DeckInterface, SuitInterface, RankInterface};
use App\PokerChanceCalculator\Card\BuilderInterface as CardBuilderInterface;
use App\PokerChanceCalculator\Deck\{ProviderInterface as DeckProviderInterface,
                                    StorageInterface as DeckStorageInterface};
use App\PokerChanceCalculator\Suit\BuilderInterface as SuitBuilderInterface;
use App\PokerChanceCalculator\Rank\BuilderInterface as RankBuilderInterface;

use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    /**
     * @var CardBuilderInterface
     */
    protected $cardBuilderMock;

    /**
     * @var DeckProviderInterface
     */
    protected $deckProviderMock;

    /**
     * @var DeckStorageInterface
     */
    protected $deckStorageMock;

    /**
     * @var RankBuilderInterface
     */
    protected $rankBuilderMock;

    /**
     * @var SuitBuilderInterface
     */
    protected $suitBuilderMock;

    /**
     * @var CalculatorInterface
     */
    protected $calculatorMock;
    /**
     * @var Manager
     */
    protected $model;

    public function setUp()
    {
        $this->cardBuilderMock = $this->createMock(CardBuilderInterface::class);
        $this->deckProviderMock = $this->createMock(DeckProviderInterface::class);
        $this->deckStorageMock = $this->createMock(DeckStorageInterface::class);
        $this->rankBuilderMock = $this->createMock(RankBuilderInterface::class);
        $this->suitBuilderMock = $this->createMock(SuitBuilderInterface::class);
        $this->calculatorMock = $this->createMock(CalculatorInterface::class);

        $this->model = new Manager(
            $this->cardBuilderMock,
            $this->deckProviderMock,
            $this->deckStorageMock,
            $this->rankBuilderMock,
            $this->suitBuilderMock,
            $this->calculatorMock
        );
    }

    public function testGetProbability()
    {
        $suit = 'C';
        $rank = 'A';
        $probability = 0.5;

        $suitMock = $this->createMock(SuitInterface::class);

        $this->suitBuilderMock->expects($this->once())
            ->method('build')
            ->with($suit)
            ->willReturn($suitMock);

        $rankMock = $this->createMock(RankInterface::class);

        $this->rankBuilderMock->expects($this->once())
            ->method('build')
            ->with($rank)
            ->willReturn($rankMock);

        $cardMock = $this->createMock(CardInterface::class);

        $this->cardBuilderMock->expects($this->once())
            ->method('build')
            ->with([
                CardBuilderInterface::SUIT => $suitMock,
                CardBuilderInterface::RANK => $rankMock
            ])->willReturn($cardMock);

        $deckMock = $this->createMock(DeckInterface::class);

        $this->deckProviderMock->expects($this->once())
            ->method('getData')
            ->willReturn($deckMock);

        $this->calculatorMock->expects($this->once())
            ->method('getCardProbability')
            ->with($deckMock, $cardMock)
            ->willReturn($probability);

        $result = $this->model->getProbability($suit, $rank);

        $this->assertEquals($probability, $result);
    }

    public function testGetRemainingCards()
    {
        $remaining = 12;
        $deckMock = $this->createMock(DeckInterface::class);

        $deckMock->expects($this->once())
            ->method('getRemaining')
            ->willReturn($remaining);

        $this->deckProviderMock->expects($this->once())
            ->method('getData')
            ->willReturn($deckMock);

        $result = $this->model->getRemainingCards();

        $this->assertEquals($remaining, $result);
    }

    public function testGetCards()
    {
        $cards = [
            $this->createMock(CardInterface::class),
            $this->createMock(CardInterface::class)];

        $deckMock = $this->createMock(DeckInterface::class);

        $deckMock->expects($this->once())
            ->method('getCards')
            ->willReturn($cards);

        $this->deckProviderMock->expects($this->once())
            ->method('getData')
            ->willReturn($deckMock);

        $result = $this->model->getCards();

        $this->assertEquals($cards, $result);
    }

    public function testResetDeck()
    {
        $this->deckStorageMock->expects($this->once())
            ->method('purge');

        $this->model->resetDeck();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Deck has no remaining cards.
     */
    public function testDrawCardShouldThrowException()
    {
        $deckMock = $this->createMock(DeckInterface::class);

        $deckMock->expects($this->once())
            ->method('getRemaining')
            ->willReturn(0);


        $this->deckProviderMock->expects($this->once())
            ->method('getData')
            ->willReturn($deckMock);

        $this->model->drawCard();
    }

    public function testDrawCardShouldReturnCardInterface()
    {
        $cardMock = $this->createMock(CardInterface::class);
        $deckMock = $this->createMock(DeckInterface::class);

        $deckMock->expects($this->once())
            ->method('getRemaining')
            ->willReturn(1);

        $deckMock->expects($this->once())
            ->method('draw')
            ->willReturn($cardMock);

        $this->deckProviderMock->expects($this->once())
            ->method('getData')
            ->willReturn($deckMock);

        $this->deckStorageMock->expects($this->once())
            ->method('store')
            ->with($deckMock);

        $result = $this->model->drawCard();

        $this->assertSame($cardMock, $result);
    }
}