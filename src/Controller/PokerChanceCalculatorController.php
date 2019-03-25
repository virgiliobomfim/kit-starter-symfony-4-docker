<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{RedirectResponse, Request, Response};
use Symfony\Component\Routing\RouterInterface;

use App\PokerChanceCalculator\ManagerInterface;

class PokerChanceCalculatorController
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ManagerInterface
     */
    private $manager;

    public function __construct(
        RouterInterface $router,
        ManagerInterface $manager
    ) {
        $this->router = $router;
        $this->manager = $manager;
    }

    public function index(Request $request)
    {
        $reset = $request->get('reset', null);
        $remaining = $this->manager->getRemainingCards();
        $suit = $request->get('suit', null);
        $rank = $request->get('rank', null);

        if ($reset || $remaining == 0) {
            var_dump($this->router->generate('poker_chance_calculator_card_picker'));
            $this->manager->resetDeck();
            return new RedirectResponse($this->getUrl());
        }


        if (!$suit || !$rank) {
            $this->manager->resetDeck();
            return new RedirectResponse(
                $this->router->generate('poker_chance_calculator_card_picker')
            );
        }

        $card = $suit.$rank;
        $draw = $request->get('draw', null);
        $drawnCard = null;

        if ($draw) {
            $drawnCard = $this->manager->drawCard();
        }

        $probability = ($this->manager->getProbability($suit, $rank) * 100) . '%';

        $indexUrl = $this->router->generate('index');

        $resetUrl = $this->getUrl(true);

        $message = sprintf("Keep trying! Chances are getting bigger (%s)...", $probability);
        $reset = false;
        if ($card == $drawnCard) {
            $reset = true;
            $message = sprintf("Got it, the chance was %s", $probability);
        }

        $drawUrl = $this->getUrl($reset, true, $suit, $rank);

        return new Response(
            '<html><body><ul>'
                .'<li><a href="' . $indexUrl . '">Index</a></li>'
                .'<li><a href="' . $drawUrl . '">Draw Card</a></li>'
                .'<li><a href="' . $resetUrl . '">Reset Deck</a></li>'
                .'<li>Card Picked: '. $card . '</li>'
                .'<li>Card Drawn: '. $drawnCard . '</li>'
                .'<li>Message: '. $message . '</li>'
                .'<li>Reamining Cards: '. $remaining . '</li>'
            .'</body></html>'
        );
    }

    public function cardPicker(Request $request)
    {
        $suit = $request->get('suit', null);
        $rank = $request->get('rank', null);

        if ($suit && $rank) {
            return new RedirectResponse(
                $this->getUrl(false, false, $suit, $rank)
            );
        }

        $cards = $this->manager->getCards();
        $cardsMarkup = '';

        foreach ($cards as $card) {
            $cardsMarkup.= '<li><a href="'
                . $this->getUrl(false, false, $card->getSuit(), $card->getRank())
                . '">'. $card . '</a></li>';
        }

        $indexUrl = $this->router->generate('index');

        return new Response(
            '<html><body>'
                .'<ul><li><a href="' . $indexUrl . '">Index</a></li></ul>'
                .'<p>Pick a card</p>'
                .'<ul>' . $cardsMarkup . '</ul>'
            .'</body></html>'
        );
    }

    private function getUrl(bool $reset = false, bool $draw = false,
        string $suit = null, string $rank = null) : string {
        return $this->router->generate('poker_chance_calculator', [
            'reset' => $reset,
            'suit' => $suit,
            'rank' => $rank,
            'draw' => $draw]);
    }
}