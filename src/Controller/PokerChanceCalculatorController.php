<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{RedirectResponse, Request, Response};
use Symfony\Component\Routing\RouterInterface;

use App\PokerChanceCalculator\ManagerInterface;
use App\PokerChanceCalculator\CardInterface;

class PokerChanceCalculatorController
{
    const RESET = 'reset';
    const SUIT = 'suit';
    const RANK = 'rank';

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @var CardInterface
     */
    private $drawnCard;

    /**
     * @var Request
     */
    private $request;

    public function __construct(
        RouterInterface $router,
        ManagerInterface $manager
    ) {
        $this->router = $router;
        $this->manager = $manager;
    }

    public function index(Request $request)
    {
        $this->setRequest($request);

        if ($this->shouldResetDeck()) {
            $this->resetDeck();
        }

        if ($this->shouldForceCardPick()) {
            return $this->forceCardPick();
        }

        return new Response(
            '<html><body><ul>'
                .'<li><a href="' . $this->getIndexUrl() . '">Index</a></li>'
                .'<li><a href="' . $this->getUrl() . '">'. $this->getActionLabel() . '</a></li>'
                .'<li><a href="' . $this->getResetUrl() . '">Reset Deck</a></li>'
                .'<li>Card Picked: '. $this->getPickedCard() . '</li>'
                .'<li>Card Drawn: '. $this->getDrawnCard() . '</li>'
                .'<li>Message: '. $this->getMessage() . '</li>'
                .'<li>Reamining Cards: '. $this->getRemainingCards() . '</li>'
            .'</body></html>'
        );
    }

    public function cardPicker(Request $request)
    {
        $this->setRequest($request);

        $this->resetDeck();

        if ($this->cardIsPicked()) {
            return $this->restart();
        }

        return new Response(
            '<html><body>'
                .'<ul><li><a href="' . $this->getIndexUrl() . '">Index</a></li></ul>'
                .'<p>Pick a card</p>'
                .'<ul>' . $this->getCardsMarkup() . '</ul>'
            .'</body></html>'
        );
    }

    private function setRequest(Request $request) : void
    {
        $this->request = $request;
    }

    private function getCardsMarkup() : string
    {
        $markup = '';
        foreach ($this->getCards() as $card) {
            $markup.= $this->getCardMarkup($card);
        }

        return $markup;
    }

    private function getCardMarkup(CardInterface $card) : string
    {
        return '<li><a href="' . $this->getCardUrl($card) . '">'. $card
                                                                . '</a></li>';
    }

    private function getCards() : array
    {
        return $this->manager->getCards();
    }

    private function getMessage() : string
    {
        $probability = $this->getProbability();
        $message = sprintf("Keep trying! Chances are getting bigger (%s)...",
                                                                 $probability);
        if ($this->cardsMatch()) {
            $message = sprintf("Got it, the chance was %s", $probability);
        }

        return $message;
    }

    private function cardsMatch() : bool
    {
        return $this->getPickedCard() == $this->getDrawnCard();
    }

    private function getResetUrl() : string
    {
        return $this->router->generate('poker_chance_calculator', [
            self::RESET => true]);
    }

    private function getIndexUrl() : string
    {
        return $this->router->generate('index');
    }

    private function getProbability() : string
    {
        $percentage = 0;
        if ($this->getRemainingCards()) {
            $percentage = $this->manager->getProbability($this->getSuit(),
                                                         $this->getRank());
        }

        return ($percentage * 100) . '%';
    }

    private function drawCard() : CardInterface
    {
        return $this->manager->drawCard();
    }

    private function getDrawnCard() : ?CardInterface
    {
        if (empty($this->drawnCard) && $this->getRemainingCards()) {
            $this->drawnCard = $this->drawCard();
        }

        return $this->drawnCard;
    }

    private function getPickedCard() : string
    {
        return $this->getSuit() . $this->getRank();
    }

    private function cardIsPicked() : bool
    {
        return $this->getSuit() && $this->getRank();
    }

    private function getRemainingCards() : int
    {
        return $this->manager->getRemainingCards();
    }

    private function resetDeck() : void
    {
        $this->manager->resetDeck();
    }

    private function shouldResetDeck() : bool
    {
        return $this->getReset() || $this->noMoreCardsRemaining()
            || $this->shouldForceCardPick();
    }

    private function noMoreCardsRemaining() : bool
    {
        return $this->getRemainingCards() == 0;
    }

    private function getReset() : ?bool
    {
        return $this->request->get(self::RESET, null);
    }

    private function getSuit() : ?string
    {
        return $this->request->get(self::SUIT, null);
    }

    private function getRank() : ?string
    {
        return $this->request->get(self::RANK, null);
    }

    private function restart() : RedirectResponse
    {
        return new RedirectResponse($this->getUrl());
    }

    private function shouldForceCardPick() : bool
    {
        return $this->getSuit() == null || $this->getRank() == null;
    }

    private function forceCardPick() : RedirectResponse
    {
        return new RedirectResponse(
            $this->getCardPickUrl()
        );
    }

    private function getActionLabel() : string
    {
        if ($this->cardsMatch()) {
            return 'Pick new card';
        }

        return 'Draw card';
    }

    private function getUrl() : string
    {
        if ($this->cardsMatch()) {
            return $this->getCardPickUrl();
        }

        return $this->getDrawUrl();
    }

    private function getCardPickUrl() : string
    {
        return $this->router->generate('poker_chance_calculator_card_picker');
    }


    private function getDrawUrl() : string
    {
        return $this->router->generate('poker_chance_calculator', [
            self::RESET => $this->getReset() || $this->cardsMatch(),
            self::SUIT => $this->getSuit(),
            self::RANK => $this->getRank()]);
    }

    private function getCardUrl(CardInterface $card) : string
    {
        return $this->router->generate('poker_chance_calculator', [
            self::RESET => $this->getReset(),
            self::SUIT => (string) $card->getSuit(),
            self::RANK => (string) $card->getRank()]);
    }
}