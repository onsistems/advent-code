<?php

// Advent of Code 2023 - Day 13: Point of Incidence

$data = file_get_contents('input.txt');
// $data = "#.##..##.
// ..#.##.#.
// ##......#
// ##......#
// ..#.##.#.
// ..##..##.
// #.#.##.#.

// #...##..#
// #....#..#
// ..##..###
// #####.##.
// #####.##.
// ..##..###
// #....#..#";
$data = preg_split("/(\n){2,}|(\r\n){2,}/", $data);
var_dump($data);die;


function get_pairs(array $pattern)
{
	$pairs = [];
	foreach ($pattern as $key => $row) {
		for ($i=$key+1; $i < count($pattern) ; $i++) { 
			if($row == $pattern[$i] && !in_array($pattern[$i], $pairs))
			{
				$pairs[$i]=$pattern[$i];
			}
		}
		
	}
	return $pairs;
}

$total = 0;
foreach ($data as $key => $pattern) {
	$horizontal = preg_split("/(\n){1,}|(\r\n){1,}/", $pattern);
	$h_data = get_pairs($horizontal);

	$vertical = array_map(fn($e)=>str_split($e), $horizontal);
	$vertical = array_map(null, ...$vertical);
	$vertical = array_map(fn($e)=>implode("", $e), $vertical);
	$v_data = get_pairs($vertical);

	if(count($h_data)>count($v_data))
	{
		$total += min(array_keys($h_data))*100;
	} else {
		$total += min(array_keys($v_data));
	}
}

echo $total;
