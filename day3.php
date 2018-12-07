<?php
require __DIR__ . '/vendor/autoload.php';

use kevinquinnyo\AdventOfCode\Fabric;

echo 'PART 1:' . PHP_EOL;
$answer = (new Fabric)
    ->buildMatrix()
    ->process()
    ->getOverlappingArea();
echo sprintf('ANSWER: %d', $answer) . PHP_EOL;

echo 'PART 2:' . PHP_EOL;
$answer = (new Fabric)
    ->buildMatrix()
    ->getClaimWithNoOverlaps();
echo sprintf('ANSWER: %d', $answer) . PHP_EOL;
