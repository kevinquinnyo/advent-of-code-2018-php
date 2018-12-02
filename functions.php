<?php
function debug($thing) {
    return var_dump($thing);
}
function _time($callable) {
	$start = microtime(true);
	$result = is_callable($callable) ? $callable() : $callable;
	$end = microtime(true);
	$elapsed = $end - $start;

	return compact('result', 'elapsed');
}

function puzzle(string $msg, callable $callable, callable $printer = null) {
    echo $msg . PHP_EOL;

    $result = _time($callable);
    if ($printer) {
        $printer($result);
    } else {
        echo sprintf('ANSWER: %d', $result['result']) . PHP_EOL;
        echo sprintf('Execution time: %f seconds', $result['elapsed']) . PHP_EOL;
    }

    return $result;
}
