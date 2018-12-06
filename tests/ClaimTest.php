<?php
namespace kevinquinnyo\AdventOfCode\Test;

use InvalidArgumentException;
use kevinquinnyo\AdventOfCode\Claim;
use PHPUnit\Framework\TestCase;

class ClaimTest extends TestCase
{
    /**
     * testExplode
     *
     * @group claim-new
     *
     */
    public function testExplode()
    {
        $claim = '#1 @ 3,3: 3x2';
        $claim = new Claim($claim);

        $this->assertEquals(3, $claim->fromLeft);
    }

    /**
     * testExplode
     *
     * @group claim-new
     *
     */
    public function testExplodeThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $claim = 'asdfasdf';
        $claim = new Claim($claim);

        $this->assertEquals(3, $claim->fromLeft);
    }
}
