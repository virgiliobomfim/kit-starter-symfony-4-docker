<?php

namespace App\Tests\PhraseAnalyser\Statistics;

use App\PhraseAnalyser\Statistics\{ProviderInterface, MaxDistanceBetweenChars};

use PHPUnit\Framework\TestCase;

class MaxDistanceBetweenCharsTest extends TestCase
{
    /**
     * @var MaxDistanceBetweenChars
     */
    protected $model;

    public function setUp()
    {
        $this->model = new MaxDistanceBetweenChars;
    }

    public function testGet()
    {
        $phrase = 'asdasdasdf';
        $expected = [
            'a' => [ProviderInterface::MAX_DISTANCE => 6],
            's' => [ProviderInterface::MAX_DISTANCE => 6],
            'd' => [ProviderInterface::MAX_DISTANCE => 6]
        ];

        $result = $this->model->get($phrase);

        $this->assertEquals($expected, $result);
    }
}