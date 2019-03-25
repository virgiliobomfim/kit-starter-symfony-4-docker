<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class PhraseAnalyserController
{
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $indexUrl = $this->router->generate('index');
        $pokerCalculatorUrl = $this->router->generate('poker_chance_calculator');

        return new Response(
            '<html><body><ul><li><a href="'.$indexUrl.'">Index</a></li><li><a href="'.$pokerCalculatorUrl.'">Poker Chance Calculator</a></li></ul></body></html>'
        );
    }
}