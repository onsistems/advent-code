<?php
// Advent of Code - Day 3

$data = file_get_contents('data.txt');
$arr_field = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

function toboggan($right, $down){
	$pos = 0;
	$row = 0;
	$tree_number = 0;
	global $arr_field;
	foreach ($arr_field as $rowt) {
		if($row == count($arr_field)-1) {
			break;
		}
		$pos += $right;
		$row += $down;
		$max = strlen($rowt)-1;
		if($pos > $max){
			$pos = $pos - $max - 1;
		}
		if($arr_field[$row][$pos] == "#"){
			$tree_number++;
		}
	}
	return $tree_number;
}

// Part1
echo toboggan(3,1)."\n";

// Part2
$slopes1 = toboggan(1,1);
$slopes2 = toboggan(3,1);
$slopes3 = toboggan(5,1);
$slopes4 = toboggan(7,1);
$slopes5 = toboggan(1,2);

echo $slopes1*$slopes2*$slopes3*$slopes4*$slopes5;