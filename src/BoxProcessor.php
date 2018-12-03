<?php
namespace kevinquinnyo\AdventOfCode;

use kevinquinnyo\AdventOfCode\Data\Warehouse;

class BoxProcessor
{
    private $boxIds = null;
    private $threes = [];
    private $twos = [];
    private $processed = false;

    public function __construct(array $boxIds = null)
    {
        if ($boxIds === null) {
            $boxIds = (new Warehouse)();
        }

        $this->boxIds = $boxIds;
    }

    protected function getCounts(string $string)
    {
        $chars = str_split($string);

        return array_count_values($chars);
    }

    public function hasExactly(string $string, int $n)
    {
        $counts = $this->getCounts($string);

        return in_array($n, $counts);
    }

    public function buildTwosAndThrees()
    {
        if (! $this->processed) {
            foreach ($this->boxIds as $boxId) {
                if ($this->hasExactly($boxId, 3) === true) {
                    $this->threes[] = $boxId;
                }
                if ($this->hasExactly($boxId, 2) === true) {
                    $this->twos[] = $boxId;
                }
            }
            $this->processed = true;
        }

        return $this;
    }

    public function getCheckSum()
    {
        $this->buildTwosAndThrees();

        return count($this->twos) * count($this->threes);
    }

    public function getCorrectboxId()
    {
        foreach ($this->boxIds as $a) {
            foreach ($this->boxIds as $b) {
                if ($a === $b) {
                    continue;
                }

                $aArray = str_split($a);
                $bArray = str_split($b);
                $mismatches = [];

                foreach ($aArray as $key => $val) {
                    if (count($mismatches) > 1) {
                        continue 2;
                    }
                    if ($val !== $bArray[$key]) {
                        $mismatches[] = $key;
                    }
                }

                if (count($mismatches) === 1) {
                    unset($aArray[$mismatches[0]]);

                    return implode('', $aArray);
                }
            }
        }

        return null;
    }
}
