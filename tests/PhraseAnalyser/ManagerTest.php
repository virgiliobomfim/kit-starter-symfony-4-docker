<?php

namespace App\Tests\PhraseAnalyser;

use App\PhraseAnalyser\Manager;
use App\PhraseAnalyser\Statistics\ProviderInterface as StatisticsProviderInterface;

use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    /**
     * @var StatisticsProviderInterface
     */
    protected $statisticsProviderMock;

    /**
     * @var Manager
     */
    protected $model;

    public function setUp()
    {
        $this->statisticsProviderMock = $this->createMock(StatisticsProviderInterface::class);

        $this->model = new Manager(
            $this->statisticsProviderMock
        );
    }

    public function testGetStatistics()
    {
        $phrase = 'placeholder';
        $statistics = ['A' => 1, 'B' => 2];
        $this->statisticsProviderMock->expects($this->once())
            ->method('get')
            ->with($phrase)
            ->willReturn($statistics);

        $result = $this->model->getStatistics($phrase);

        $this->assertEquals($statistics, $result);
    }
}