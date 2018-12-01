<?php
namespace kevinquinnyo\AdventOfCode;

use InvalidArgumentException;
use RuntimeException;
use kevinquinnyo\AdventOfCode\Data\Sequence;

class Frequency
{
    private $sequence = null;
    private $maxRecursion = 1024;

    public function __construct(array $sequence = null)
    {
        if ($sequence === null) {
            $sequence = (new Sequence)();
        }

        $this->sequence = $sequence;
    }

    public function setMaxRecursion(int $maxRecursion)
    {
        $this->maxRecursion = $maxRecursion;

        return $this;
    }

    public function getSequence()
    {
        return $this->sequence;
    }

    public static function splitItem(string $item)
    {
        if (!preg_match('/^([+-]){1}(\d+)$/', $item, $matches)) {
            throw new InvalidArgumentException('Invalid input.');
        }

        [, $sign, $number] = $matches;

        return compact('sign', 'number');
    }

    public static function doArithmetic($sign, int $current, int $number)
    {
		if ($sign === '-') {
			return $current - $number;
		}

		if ($sign === '+') {
			return $current + $number;
		}

		throw new InvalidArgumentException('Invalid input.');
    }

    public function processItem(string $item, $current = 0)
    {
        $item = $this->splitItem($item);

        return $this->doArithmetic($item['sign'], $current, $item['number']); 
    }

    public function process()
    {
        $current = 0;
        foreach ($this->getSequence() as $item) {
            $current = $this->processItem($item, $current);
        }

        return $current;
    }

    public function getDuplicateResult($current = 0, $results = [0], $iteration = 1)
    {
        if ($iteration === $this->maxRecursion) {
            throw new RuntimeException(
                sprintf(
                    'Reached max recursion limit of %d.',
                    $iteration
                )
            );
        }

        $sequence = $this->getSequence();
        foreach ($sequence as $item) {
            $current = $this->processItem($item, $current);

            if (in_array($current, $results) === true) {
                return [
                    'duplicate' => $current,
                    'iteration' => $iteration,
                ];
            }

            array_push($results, $current);
        }
        ++$iteration;

        return $this->getDuplicateResult($current, $results, $iteration);
    }
}
