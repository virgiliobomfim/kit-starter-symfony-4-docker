<?php

namespace App\Tests\PhraseAnalyser\Statistics;

use App\PhraseAnalyser\Statistics\{ProviderInterface, CharOccurrences};

use PHPUnit\Framework\TestCase;

class CharOccurrencesTest extends TestCase
{
    /**
     * @var CharOccurrences
     */
    protected $model;

    public function setUp()
    {
        $this->model = new CharOccurrences;
    }

    public function testGet()
    {
        $phrase = 'asdasdasdf';
        $expected = [
            'a' => [ProviderInterface::OCCURRENCES => 3],
            's' => [ProviderInterface::OCCURRENCES => 3],
            'd' => [ProviderInterface::OCCURRENCES => 3],
            'f' => [ProviderInterface::OCCURRENCES => 1]
        ];

        $result = $this->model->get($phrase);

        $this->assertEquals($expected, $result);
    }
}