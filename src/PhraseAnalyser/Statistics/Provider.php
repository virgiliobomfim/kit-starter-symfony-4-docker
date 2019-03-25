<?php

namespace App\PhraseAnalyser\Statistics;

class Provider implements ProviderInterface
{
    /**
     * @var ProviderInterface[]
     */
    private $providers = [];

    public function __construct(ProviderInterface ...$providers)
    {
        $this->providers = $providers;
    }

    public function get(string $phrase = '') : array
    {
        $statistics = [];

        foreach ($this->providers as $provider) {
            $statistics = array_merge_recursive($statistics, $provider->get($phrase));

        }

        return $statistics;
    }
}