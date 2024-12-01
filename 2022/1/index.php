<?php

// Advent of Code 2022 - Day 1: Calorie Counting

$data = file_get_contents('input.txt');
$arr_number = explode(';',$data);

function inter($n) { return (int)$n; }
$count_calorie = array_map(function($bag){
	$bag_number = array_map("inter", preg_split('/\n+/', $bag, -1, PREG_SPLIT_NO_EMPTY));
	return array_sum($bag_number);
},$arr_number);


var_dump(max($count_calorie)); //72240

sort($count_calorie,SORT_NUMERIC);
$new_count_calorie = array_reverse($count_calorie);

var_dump($new_count_calorie[0]+$new_count_calorie[1]+$new_count_calorie[2]); //210957


