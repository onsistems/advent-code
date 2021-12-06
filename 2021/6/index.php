<?php
// Advent of Code - Day 6
ini_set('memory_limit','10240M');

$arr_data = [3,4,3,1,2];
$days = 256; //Part 1:80, //Part 2:256


foreach ($population as $key) {
    $groupedPopulation[$key]++;
}

for ($day = 1; $day <= $days; $day++) {
    $newPopulation = $groupedPopulation[0];

    for ($x = 1; $x <= 8; $x++) {
        $groupedPopulation[$x-1] = $groupedPopulation[$x];
    }

    $groupedPopulation[6] += $newPopulation;
    $groupedPopulation[8] = $newPopulation;

    echo 'Day '. $day . ': ' . array_sum($groupedPopulation) . PHP_EOL;
}
// Count how many fish are by age
echo count($arr_data); //355386