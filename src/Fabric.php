<?php
namespace kevinquinnyo\AdventOfCode;

use kevinquinnyo\AdventOfCode\Data\Fabric as FabricData;
use kevinquinnyo\AdventOfCode\Claim;

class Fabric
{
    private $data;
    private $size;
    public function __construct(array $data = null, int $size = 1000)
    {
        if ($data === null) {
            $data = (new FabricData)();
        }

        $this->data = $data;
        $this->size = $size;
    }

    public function buildMatrix()
    {
        $this->matrix = array_fill(0, $this->size, array_fill(0, $this->size, 0));

        return $this;
    }

    public function getMatrix()
    {
        return $this->matrix;
    }

    public function getConsumption(Claim $claim)
    {
        $bottom = $this->size - $claim->fromTop - $claim->height;
        $left = $claim->fromLeft;
        $rows = array_fill($bottom, $claim->height, array_fill($left, $claim->width, 'x'));

        return $rows;
    }

    public function process()
    {
        foreach ($this->data as $claim) {
            $claim = new Claim($claim);
            $rows = $this->getConsumption($claim);

            foreach ($rows as $row => $cols) {
                foreach ($cols as $col => $val) {
                    if ($this->matrix[$row][$col] === 0) {
                        $this->matrix[$row][$col] = 'x';

                        continue;
                    }
                    if ($this->matrix[$row][$col] === 'x') {
                        $this->matrix[$row][$col] = 'consumed';
                    }
                }
            }
        }

        return $this;
    }

    public function getOverlappingArea()
    {
        $count = 0;
        foreach ($this->matrix as $row => $cols) {
            foreach ($cols as $val) {
                if ($val === 'consumed') {
                    ++$count;
                }
            }
        }

        return $count;
    }

    public function getClaimWithNoOverlaps()
    {
        // welp fuck it i don't care anymore
        $this->process();
        foreach ($this->data as $claim) {
            $claim = new Claim($claim);
            $rows = $this->getConsumption($claim);

            $consumed = false;
            foreach ($rows as $row => $cols) {
                foreach ($cols as $col => $val) {
                    $current = $this->matrix[$row][$col];
                    if ($current === 'consumed') {
                        $consumed = true;
                        continue;
                    }
                }
            }

            if ($consumed === false) {
                return $claim->id; // i hate this code
            }
        }

        return null;
    }
}
