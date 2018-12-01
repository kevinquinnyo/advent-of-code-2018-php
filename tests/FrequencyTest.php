<?php
namespace kevinquinnyo\AdventOfCode\Test;

use InvalidArgumentException;
use RuntimeException;
use kevinquinnyo\AdventOfCode\Frequency;
use PHPUnit\Framework\TestCase;

class FrequencyTest extends TestCase
{
    public function testGetSequence()
    {
        $seq = ['+1', '-1'];
        $freq = new Frequency($seq);

        $this->assertEquals($seq, $freq->getSequence());
    }

    public function testSplitItemPositive()
    {
        $item = '+42'; 
        $split = Frequency::splitItem($item);
        $expected = [
            'sign' => '+',
            'number' => '42',
        ];

        $this->assertSame($expected, $split);
    }

    public function testSplitItemNegative()
    {
        $item = '-42'; 
        $split = Frequency::splitItem($item);
        $expected = [
            'sign' => '-',
            'number' => '42',
        ];

        $this->assertSame($expected, $split);
    }

    public function testSplitInvalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $item = 'asdf'; 
        $split = Frequency::splitItem($item);
    }

    public function testDoArithmeticPositive()
    {
        $sign = '+';
        $current = 1;
        $number = 1;
        $result = Frequency::doArithmetic($sign, $current, $number);

        $this->assertSame(2, $result);
    }

    public function testDoArithmeticNegative()
    {
        $sign = '-';
        $current = 1;
        $number = 1;
        $result = Frequency::doArithmetic($sign, $current, $number);

        $this->assertSame(0, $result);
    }

    public function testGetDuplicateResultWithNoRecursion()
    {
        $seq = [
            '+1',
            '-1', // back to zero
            '+20', // never make it here
        ];
        $freq = new Frequency($seq);
        $duplicate = $freq->getDuplicateResult();

        $expected = [
            'duplicate' => 0,
            'iteration' => 1,
        ];

        $this->assertSame($expected, $duplicate);
    }

    public function testGetDuplicateResultWithRecursion()
    {
        $seq = [
            '-2',
            '+1',
        ];
        // iteration 1:  0, -2, +1 = -1
        // iteration 2: -1, -2, +1 = -2 (duplicate found)

        $freq = new Frequency($seq);
        $duplicate = $freq->getDuplicateResult();

        $expected = [
            'duplicate' => -2,
            'iteration' => 2,
        ];

        $this->assertSame($expected, $duplicate);
    }

    public function testGetDuplicateResultHitsMaxRecursionLimit()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Reached max recursion limit of 1024.');
        $seq = [
            '+1', // this will increment forever
        ];

        $freq = new Frequency($seq);
        $duplicate = $freq->getDuplicateResult();
    }

    public function testProcess()
    {
        $tests = [
            [
                'seq' => [
                    '+1',
                    '-1',
                    '+20',
                ],
                'expected' => 20,
            ],
            [
                'seq' => [
                    '-1',
                    '-2',
                    '+1',
                ],
                'expected' => -2,
            ],
        ];

        foreach ($tests as $test) {
            $freq = new Frequency($test['seq']);
            $result = $freq->process();

            $this->assertSame($test['expected'], $result);
        }
    }
}
