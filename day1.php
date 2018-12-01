<?php
require __DIR__ . '/vendor/autoload.php';

use kevinquinnyo\AdventOfCode\Frequency;

function _time(callable $callable) {
	$start = microtime(true);
	$result = $callable();
	$end = microtime(true);
	$elapsed = $end - $start;

	return compact('result', 'elapsed');
}

echo 'Puzzle 1: Get the sum of the entire sequence.' . PHP_EOL;
$result = _time(function () {
	return (new Frequency)->process();
});
echo sprintf('ANSWER: %d', $result['result']) . PHP_EOL;
echo sprintf('Execution time: %s seconds', $result['elapsed']) . PHP_EOL;

echo PHP_EOL;

echo 'Puzzle 2: Find the first duplicate sum recursing the sequence if neccesary. (this might take a while)' . PHP_EOL;
$start = microtime(true);
try {
    $result = (new Frequency)->getDuplicateResult(); 
    $msg = sprintf(
        'ANSWER: %d found in %d iterations of sequence.',
        $result['duplicate'],
        $result['iteration']
    );

    echo $msg . PHP_EOL;
} catch (RuntimeException $e) {
    echo sprintf('ERROR: %s', $e->getMessage()) . PHP_EOL;
} finally {
    $elapsed = microtime(true) - $start;
    echo sprintf('Execution time: %s seconds', $elapsed) . PHP_EOL;
}

echo PHP_EOL;
