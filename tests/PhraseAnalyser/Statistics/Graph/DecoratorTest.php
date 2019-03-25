<?php

namespace App\Tests\PhraseAnalyser\Statistics\Graph;

use App\PhraseAnalyser\Statistics\ProviderInterface;
use App\PhraseAnalyser\Statistics\Graph\Decorator;

use PHPUnit\Framework\TestCase;

class DecoratorTest extends TestCase
{
    /**
     * @var ProviderInterface
     */
    protected $statisticsProviderMock;
    /**
     * @var Decorator
     */
    protected $model;

    public function setUp()
    {
        $this->statisticsProviderMock = $this->createMock(ProviderInterface::class);

        $this->model = new Decorator(
            $this->statisticsProviderMock
        );
    }

    public function testGetShouldReturnGraphFormat()
    {
        $phrase = 'placeholder';
        $statistics = [
            'a' => [
                ProviderInterface::AFTER => ['b'],
                ProviderInterface::BEFORE => ['c'],
                ProviderInterface::MAX_DISTANCE => 5,
                ProviderInterface::OCCURRENCES => 10
            ]
        ];
        $expected = [
            ['a', 10, 'before: c after: b max-distance: 5']
        ];

        $this->statisticsProviderMock->expects($this->once())
            ->method('get')
            ->with($phrase)
            ->willReturn($statistics);

        $result = $this->model->get($phrase);

        $this->assertEquals($expected, $result);
    }
}