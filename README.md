# Advent of Code 2018 Solutions (PHP)

My attempt at solving the Advent of Code puzzles using PHP.

## Requirements:
```
- composer
- php 7.1+
```

## Usage:
```
git clone https://github.com/kevinquinnyo/advent-of-code-2018-php.git
cd advent-of-code-2018-php
composer install
./day1.php
```

I am not sure if the 'sequence' is different for everyone, or if it's the same, but if your sequence does not match the array in `src/Data/Sequence.php`, you can override it when initializing the `Frequency` class by passing in your own array. The unit tests do this for instance.

## Running tests:
```
composer install
cp phpunit.xml.dist phpunit.xml
vendor/bin/phpunit
```
