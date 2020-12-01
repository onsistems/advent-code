<?php
// Advent of Code - Day 1

$data = file_get_contents('data.txt');
function inter($n) { return (int)$n; }
$arr_number = array_map("inter", preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY));

// Part1
foreach ($arr_number as $number) {
	if( in_array(2020-$number, $arr_number)){
		$num1 = $number;
		$num2 = 2020 - $number;
		break;
	}
}
echo $num1*$num2."\n";

// Part2
foreach ($arr_number as $number1) {
	foreach ($arr_number as $number2) {
		if( $number1 != $number2 && in_array(2020-$number1-$number2, $arr_number)){
			$num1 = $number1;
			$num2 = $number2;
			$num3 = 2020-$number1-$number2;
			break;
		}
	}
}
echo $num1*$num2*$num3;



