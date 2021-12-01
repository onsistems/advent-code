<?php
// Advent of Code - Day 1

$data = file_get_contents('input.txt');
function inter($n) { return (int)$n; }
$arr_number = array_map("inter", preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY));

echo countMayor($arr_number), PHP_EOL; //1195

function countMayor(array $data):int {
	$mayor = 0;
	foreach ($data as $key => $value) {
		if($key > 0) {
			if($value > $data[$key-1]){
				$mayor++;
			}
		}
	}
	return $mayor;
}

$threesome = [];

foreach ($arr_number as $key => $value) {
	if(isset($arr_number[$key+1]) && isset($arr_number[$key+2])) {
		array_push($threesome, $value+$arr_number[$key+1]+$arr_number[$key+2]);
	}
}

echo countMayor($threesome);//1235