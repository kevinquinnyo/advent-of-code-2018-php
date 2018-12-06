<?php
namespace kevinquinnyo\AdventOfCode;

use InvalidArgumentException;

class Claim
{
    private $id = null;
    private $fromLeft = null;
    private $fromTop = null;
    private $width = null;
    private $height = null;

    public function __construct(string $claim)
    {
        [$id, $fromLeft, $fromTop, $width, $height] = $this->explode($claim);

        $this->id = $id;
        $this->fromLeft = $fromLeft;
        $this->fromTop = $fromTop;
        $this->width = $width;
        $this->height = $height;
    }

    public function explode(string $claim)
    {
        // #123 @ 3,2: 5x4
        // #id  @ left,top: width x height
        if (preg_match('/^#(\d+)\ @\ (\d+),(\d+):\ (\d+)x(\d+)$/', $claim, $matches)) {
            $matches = array_map(function ($val) {
                return (int)$val;
            }, $matches);

            array_shift($matches);

            return $matches;
        }   

        throw new InvalidArgumentException(
            sprintf(
                'Claim data malformed \'%s\' (expected format \'#123 @ 3,2: 5x4\'',
                $claim
            ) 
        );
    }

    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }

        return null;
    }
}
