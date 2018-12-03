<?php
namespace kevinquinnyo\AdventOfCode\Test;

use kevinquinnyo\AdventOfCode\BoxProcessor;
use PHPUnit\Framework\TestCase;

class BoxProcessorTest extends TestCase
{
    public function testHasExactly()
    {
        $string = 'aaa1234';
        $checksum = new BoxProcessor;
        $hasExactly3 = $checksum->hasExactly($string, 3);

        $this->assertTrue($hasExactly3);
    }

    public function testHasExactlyFalse()
    {
        $string = 'aaa1234';
        $checksum = new BoxProcessor;
        $hasExactly3 = $checksum->hasExactly($string, 4);

        $this->assertFalse($hasExactly3);
    }

    public function testHasExactlyAgain()
    {
        $string = str_repeat('a', 42) . '1234';
        $checksum = new BoxProcessor;
        $hasExactly3 = $checksum->hasExactly($string, 42);

        $this->assertTrue($hasExactly3);
    }

    public function testProcess()
    {
        $boxIds = [
            'aaa1234',
            'aaa1234',
            'aaa1234',
            'aa1234',
            'aa1234',
            'aa1234',
            'aa1234',
        ];

        $checksum = (new BoxProcessor($boxIds))->getCheckSum();


        $this->assertSame(12, $checksum);
    }

    public function testDiffStrings()
    {
        $boxIds = [
            'abc123',
            'abX123',
        ];

        $processor = new BoxProcessor($boxIds);
        $diff = $processor->diffStrings('abc123', 'abX123');

        var_dump($diff); die();
    }

    public function testGetCorrectBoxIds()
    {
        $boxIds = [
            'asdf1',
            'fsad2', // this should not match the string above it
            'iewuroiewur',
            '3209r329hj',
            'this_Has_two_things_different',
            'this_has_two_things_Different',
            'abc123',
            'abX123',
        ];

        $correctLabel = (new BoxProcessor($boxIds))->getCorrectBoxId();
        $correctLabel = (new BoxProcessor())->getCorrectBoxId();

        $this->assertSame('ab123', $correctLabel);
    }
}
