<?php
require __DIR__ . '/vendor/autoload.php';
include(__DIR__ . '/functions.php');

use kevinquinnyo\AdventOfCode\BoxProcessor;

echo 'Puzzle 1: Get checksum for box Ids.' . PHP_EOL;
echo sprintf('ANSWER: %d', (new BoxProcessor)->getCheckSum()) . PHP_EOL;

echo PHP_EOL;

echo 'Puzzle 2: Get common letters for box IDs with only one char difference.' . PHP_EOL;
echo sprintf('ANSWER: %s', (new BoxProcessor)->getCorrectBoxId()) . PHP_EOL;

