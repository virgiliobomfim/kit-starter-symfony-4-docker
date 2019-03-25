<?php

namespace App\PhraseAnalyser;

use App\PhraseAnalyser\Statistics\ProviderInterface as StatisticsProviderInterface;

class Manager implements ManagerInterface
{
    /**
     * @var StatisticsProviderInterface
     */
    private $statisticsProvider;

    public function __construct(StatisticsProviderInterface $statisticsProvider)
    {
        $this->statisticsProvider = $statisticsProvider;
    }

    public function getStatistics(string $phrase = '') : array
    {
        return $this->statisticsProvider->get($phrase);
    }
}