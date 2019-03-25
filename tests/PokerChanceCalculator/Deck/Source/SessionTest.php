<?php

namespace App\Tests\PokerChanceCalculator\Deck\Source;

use App\PokerChanceCalculator\Deck\Source\Session;
use App\PokerChanceCalculator\Deck\ProviderInterface;
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

    public function testHasData()
    {
        $hasData = true;

        $this->sessionMock->expects($this->once())
            ->method('has')
            ->willReturn($hasData);

        $result = $this->model->hasData();

        $this->assertEquals($hasData, $result);
    }

    public function testGetData()
    {
        $data = $this->createMock(DeckInterface::class);

        $this->sessionMock->expects($this->once())
            ->method('get')
            ->willReturn($data);

        $result = $this->model->getData();

        $this->assertEquals($data, $result);
    }
}