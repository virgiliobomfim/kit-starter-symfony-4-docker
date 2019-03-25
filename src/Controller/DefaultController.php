<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class DefaultController
{
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $pokerCalculatorUrl = $this->router->generate('poker_chance_calculator');
        $phraseAnalyserUrl = $this->router->generate('phrase_analyser');

        return new Response(
            '<html><body><ul><li><a href="'.$pokerCalculatorUrl.'">Poker Chance Calculator</a></li><li><a href="'.$phraseAnalyserUrl.'">Phrase Analyser</a></li></ul></body></html>'
        );
    }
}