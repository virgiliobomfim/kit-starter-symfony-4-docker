<?php

namespace App\PhraseAnalyser\Statistics;

class CharSiblings implements ProviderInterface
{
    /**
     * @var array
     */
    private $siblings = [];

    public function get(string $phrase = '') : array
    {
        $this->resetSiblings();
        $allChars = str_split($phrase);
        $uniqueChars = array_unique($allChars);

        foreach ($allChars as $index => $char) {
            $previousSibling = $this->getPreviousSibling($index, $allChars);

            if ($previousSibling != null) {
                $this->addSibling($char, $previousSibling, // sibling is before
                                                    ProviderInterface::BEFORE);
            }

            $nextSibling = $this->getNextSibling($index, $allChars);

            if ($nextSibling != null) {
                $this->addSibling($char, $nextSibling, // sibling is after
                                                     ProviderInterface::AFTER);
            }
        }

        return $this->getSiblings();
    }

    private function getPreviousSibling(int $currentIndex, array $allChars)
                                                                    : ?string {
        $previousIndex = $currentIndex - 1;

        if ($previousIndex >= 0) {
            return $allChars[$previousIndex];
        }

        return null;
    }

    private function getNextSibling(int $currentIndex, array $allChars)
                                                                    : ?string {
        $maxIndex = sizeof($allChars) - 1;
        $nextIndex = $currentIndex + 1;

        if ($nextIndex <= $maxIndex) {
            return $allChars[$nextIndex];
        }

        return null;
    }

    private function addSibling(string $char, string $sibling,
                                                string $beforeOrAfter) : void {
        if (!isset($this->siblings[$char])) {
            $this->siblings[$char] = [];
        }

        if (!isset($this->siblings[$char][$beforeOrAfter])) {
            $this->siblings[$char][$beforeOrAfter] = [];
        }

        if (!isset($this->siblings[$char][$beforeOrAfter])) {
            $this->siblings[$char][$beforeOrAfter] = [];
        }

        if (!in_array($sibling, $this->siblings[$char][$beforeOrAfter])) {
            $this->siblings[$char][$beforeOrAfter][] = $sibling;
        }
    }

    private function getSiblings() : array
    {
        return $this->siblings;
    }

    private function resetSiblings() : void
    {
        $this->siblings = [];
    }
}