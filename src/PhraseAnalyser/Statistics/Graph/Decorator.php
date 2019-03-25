<?php

namespace App\PhraseAnalyser\Statistics\Graph;

use App\PhraseAnalyser\Statistics\ProviderInterface;

class Decorator implements ProviderInterface
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function get(string $phrase = '') : array
    {
        $charStatistics = $this->provider->get($phrase);
        $graph = [];

        foreach ($charStatistics as $char => $statistics) {
            $graph[] = [
                $char,
                $statistics[ProviderInterface::OCCURRENCES],
                $this->getThirdColumn($statistics)
            ];
        }

        return $graph;
    }

    private function getThirdColumn(array $statistics) : string
    {
        $thirdColumn = '';

        if (isset($statistics[ProviderInterface::BEFORE])) {
            $before = implode(",", $statistics[ProviderInterface::BEFORE]);
            $thirdColumn = 'before: ' . $before . ' ';
        }

        if (isset($statistics[ProviderInterface::AFTER])) {
            $after = implode(",", $statistics[ProviderInterface::AFTER]);
            $thirdColumn.= 'after: ' . $after . ' ';
        }

        if (isset($statistics[ProviderInterface::MAX_DISTANCE])) {
            $maxDistance = $statistics[ProviderInterface::MAX_DISTANCE];
            $thirdColumn.= 'max-distance: ' . $maxDistance;
        }

        return $thirdColumn;
    }
}