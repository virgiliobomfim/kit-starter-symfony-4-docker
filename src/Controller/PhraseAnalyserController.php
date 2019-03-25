<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\RouterInterface;

use App\PhraseAnalyser\ManagerInterface;

class PhraseAnalyserController
{
    const PHRASE = 'phrase';
    /**
     * @var Request
     */
    private $request;

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
        $this->setRequest($request);

        $indexUrl = $this->router->generate('index');

        return new Response(
            '<html><body><ul>'
                .'<li><a href="' . $this->getIndexUrl() . '">Index</a></li>'
                .'<form>'
                    .'<label>Input Phrase: <input name="phrase" type="text"'
                        .' value="' . $this->getPhrase() . '" maxlength="255"></label>'
                    .'<button type="submit">Go!</button>'
                .'</form>'
                . $this->getStatisticsMarkup()
            .'</ul></body></html>'
        );
    }

    private function getStatisticsMarkup() : string
    {
        $statistics = $this->getStatistics();
        $markup = '';
        foreach ($this->getStatistics() as $char => $statistics) {
            $before = null;
            if (isset($statistics['before'])) {
                $before = ' before: ' . implode(", ", $statistics['before']);
            }
            $after = null;
            if (isset($statistics['after'])) {
                $after = ' after: ' . implode(", ", $statistics['after']);
            }
            $maxDistance = null;
            if (isset($statistics['max_distance'])) {
                $maxDistance = ' max-distance: ' . $statistics['max_distance'];
            }
            $markup.= $char . ': ' . $statistics['occurrences']
                . $before
                . $after
                . $maxDistance
                . '<br>';
        }

        return $markup;
    }

    private function getStatistics() : array
    {
        if ($this->getPhrase()) {
            return $this->manager->getStatistics($this->getPhrase());
        }

        return [];
    }

    private function getIndexUrl() : string
    {
        return $this->router->generate('index');
    }

    private function setRequest(Request $request) : void
    {
        $this->request = $request;
    }

    private function getPhrase() : ?string
    {
        $phrase = $this->request->get(self::PHRASE, null);
        if (strlen($phrase) > 255) {
            throw new \UnexpectedValueException("Phrase is too long");
        }

        return $phrase;
    }
}