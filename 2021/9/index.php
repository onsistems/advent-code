<?php
// Advent of Code - Day 9

$data = file_get_contents('input.txt');
function inter($n) { return str_split($n); }
$arr_data = array_map("inter", preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY));


$lower_levels = [];
$lower_levels_pos = [];
foreach ($arr_data as $key => $value) {
	foreach ($value as $key2 => $value2) {
		$neighbour = [];
		if(isset($arr_data[$key][$key2-1])) array_push($neighbour, $arr_data[$key][$key2-1]);
		if(isset($arr_data[$key-1][$key2])) array_push($neighbour, $arr_data[$key-1][$key2]);
		if(isset($arr_data[$key][$key2+1])) array_push($neighbour, $arr_data[$key][$key2+1]);
		if(isset($arr_data[$key+1][$key2])) array_push($neighbour, $arr_data[$key+1][$key2]);

		$min = min($neighbour);

		if($value2 < $min) {
			array_push($lower_levels, (int)$value2);
			array_push($lower_levels_pos, [$key,$key2]);
		}
	}
}
$part1 = array_sum($lower_levels)+count($lower_levels);
echo "Part 1: ".$part1,PHP_EOL;

$count_basin = [];
function check_neighbour($neighbours,$count_neighbours = 0, $neighbour_check = []) {
	global $arr_data;
	$step = 0;
	$new_neighbours = [];
	foreach ($neighbours as $key => $value) {
		$i = $value[0];
		$j = $value[1];

		if(isset($arr_data[$i][$j-1]) && $arr_data[$i][$j-1]!=9 && !in_array([$i,$j-1], $neighbour_check)) {
			$step++;
			$count_neighbours++;
			array_push($neighbour_check, [$i,$j-1]);
			array_push($new_neighbours, [$i,$j-1]);
		}

		if(isset($arr_data[$i][$j+1]) && $arr_data[$i][$j+1]!=9 && !in_array([$i,$j+1], $neighbour_check)) {
			$step++;
			$count_neighbours++;
			array_push($neighbour_check, [$i,$j+1]);
			array_push($new_neighbours, [$i,$j+1]);
		}

		if(isset($arr_data[$i-1][$j]) && $arr_data[$i-1][$j]!=9 && !in_array([$i-1,$j], $neighbour_check)) {
			$step++;
			$count_neighbours++;
			array_push($neighbour_check, [$i-1,$j]);
			array_push($new_neighbours, [$i-1,$j]);
		}

		if(isset($arr_data[$i+1][$j]) && $arr_data[$i+1][$j]!=9 && !in_array([$i+1,$j], $neighbour_check)) {
			$step++;
			$count_neighbours++;
			array_push($neighbour_check, [$i+1,$j]);
			array_push($new_neighbours, [$i+1,$j]);
		}
	}

	if($step != 0) {
		return check_neighbour($new_neighbours,$count_neighbours,$neighbour_check,1);
	} else {
		return $count_neighbours+1;
	}
}

foreach ($lower_levels_pos as $key => $value) {
	$count_basin[$key] = check_neighbour([$value],0,[$value]);
}

rsort($count_basin);
$part2 = $count_basin[0]*$count_basin[1]*$count_basin[2];
echo "Part 2: ".$part2,PHP_EOL;
