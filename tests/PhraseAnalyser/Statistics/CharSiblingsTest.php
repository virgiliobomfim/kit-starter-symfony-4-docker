<?php

namespace App\Tests\PhraseAnalyser\Statistics;

use App\PhraseAnalyser\Statistics\{ProviderInterface, CharSiblings};

use PHPUnit\Framework\TestCase;

class CharSiblingsTest extends TestCase
{
    /**
     * @var CharSiblings
     */
    protected $model;

    public function setUp()
    {
        $this->model = new CharSiblings;
    }

    public function testGet()
    {
        $phrase = 'asdasdasdf';
        $expected = [
            'a' => [ProviderInterface::BEFORE => ['d'],
                    ProviderInterface::AFTER => ['s']],
            's' => [ProviderInterface::BEFORE => ['a'],
                    ProviderInterface::AFTER => ['d']],
            'd' => [ProviderInterface::BEFORE => ['s'],
                    ProviderInterface::AFTER => ['a', 'f']],
            'f' => [ProviderInterface::BEFORE => ['d']]
        ];

        $result = $this->model->get($phrase);

        $this->assertEquals($expected, $result);
    }
}