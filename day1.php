<?php
require __DIR__ . '/vendor/autoload.php';
include(__DIR__ . '/functions.php');

use kevinquinnyo\AdventOfCode\Frequency;

$msg = 'Puzzle 1: Get the sum of the entire sequence.';
$f = function () {
	return (new Frequency)->process();
};

puzzle($msg, $f);

echo PHP_EOL;

$msg = 'Puzzle 2: Find the first duplicate sum recursing the sequence if neccesary. (this might take a while)';
$f = function () {
    return (new Frequency)->getDuplicateResult(); 
};

$printer = function (array $result) {
    $elapsed = $result['elapsed'];
    $result = $result['result'];
    $duplicate = $result['duplicate'];
    $iteration = $result['iteration'];
    echo sprintf(
        'ANSWER: %d found in %d iterations of sequence.',
        $duplicate,
        $iteration
    );
    echo PHP_EOL;
    echo sprintf('Execution time: %f seconds', $elapsed) . PHP_EOL;
};

puzzle($msg, $f, $printer);

echo PHP_EOL;
