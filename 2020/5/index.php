<?php
// Advent of Code - Day 5

$data = file_get_contents('data.txt');
$arr_seats = array_map('seat_number', preg_split('/\n/', $data, -1, PREG_SPLIT_NO_EMPTY));
function seat_number($code){
	$arr = str_split($code);
	$row1=0; $row2=127; $column1=0; $column2=7;
	foreach ($arr as $letter) {
		switch ($letter) {
			case 'F':
				$row2 = intval(($row2+$row1)/2);
				break;
			case 'B':
				$row1 = intval(($row2+$row1)/2)+1;
				break;
			case 'L':
				$column2 = intval(($column2+$column1)/2);
				break;
			case 'R':
				$column1 = intval(($column2+$column1)/2)+1;
				break;
		}
	}
	return $row1*8+$column1;
}

// Part1
var_dump(max($arr_seats));

// Part2
var_dump(min(array_diff(range(min($arr_seats),max($arr_seats)), $arr_seats)));

