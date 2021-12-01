<?php
// Advent of Code - Day 1

$data = file_get_contents('input.txt');
function inter($n) { return (int)$n; }
$arr_number = array_map("inter", preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY));

var_dump($arr_number);
$mayor = 0;
foreach ($arr_number as $key => $value) {
	if($key > 0) {
		if($value > $arr_number[$key-1]){
			$mayor++;
		}
	}
}

echo $mayor;