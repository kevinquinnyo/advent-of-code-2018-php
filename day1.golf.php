<?php
ini_set("precision", 20);
require __DIR__ . '/vendor/autoload.php';
include(__DIR__ . '/functions.php');

use kevinquinnyo\AdventOfCode\Data\Sequence;

$sequence = (new Sequence)();

$msg = 'Puzzle 1: Get the sum of the entire sequence.';
puzzle($msg, function () use ($sequence) {
    return array_sum($sequence);
});

echo PHP_EOL;

$results = [0];
$findDupe = function (&$results = [0], $sum = 0, $loop = false) use ($sequence, &$findDupe) {
    foreach ($sequence as $n) {
        $sum += $n;
        if (in_array($sum, $results) && $loop) {
            return $sum;
        }
        $results[] = $sum;
    }
    return $findDupe($results, $sum, true);
};

$msg = 'Puzzle 2: Find the first duplicate sum recursing the sequence if neccesary. (this might take a while)';
puzzle($msg, $findDupe);
