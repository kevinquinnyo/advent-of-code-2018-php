<?php
namespace kevinquinnyo\AdventOfCode\Test;

use InvalidArgumentException;
use kevinquinnyo\AdventOfCode\Fabric;
use PHPUnit\Framework\TestCase;

class FabricTest extends TestCase
{
    /**
     * testProcess
     *
     * @group fabric
     */
    public function testProcess()
    {
        $data = [
            '#1 @ 3,3: 3x2',
            '#2 @ 5,2: 3x2',
            '#3 @ 1,0: 3x2',
        ];
        $fabric = new Fabric($data, 8);
        $fabric = $fabric->buildMatrix()->process();
        $matrix = $fabric->getMatrix();

        $expected = [
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
            ],
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,

            ],
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,

            ],
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 'x',
                4 => 'x',
                5 => 'x',
                6 => 0,
                7 => 0,

            ],
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 'x',
                4 => 'x',
                5 => 'consumed',
                6 => 'x',
                7 => 'x',

            ],
            [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 'x',
                6 => 'x',
                7 => 'x',

            ],
            [
                0 => 0,
                1 => 'x',
                2 => 'x',
                3 => 'x',
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,

            ],
            [
                0 => 0,
                1 => 'x',
                2 => 'x',
                3 => 'x',
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
            ],
        ];

        //$this->assertSame($expected, $matrix);
        $area = $fabric->getOverlappingArea();

        $this->assertEquals(1, $area);
    }
}
