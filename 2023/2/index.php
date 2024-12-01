<?php

// Advent of Code 2023 - Day 2: Cube Conundrum

$data = file_get_contents('input.txt');
$data = preg_split("/\r\n|\n|\r/", $data);

// Part 1
$total_sum = 0;

// In the loop, I count the imposible games
foreach ($data as $key => $value) {

	$first_split = explode(":", $value);
	$cubes = preg_split( '/[;,]/', $first_split[1] );
	
	foreach ($cubes as $key2 => $cube) {
		preg_match_all('!\d+!', $cube, $matches);
		$num = $matches[0][0];
		if(str_contains($cube,"red") && $num>12)
		{
			$total_sum += $key+1;
			break;
		}else if(str_contains($cube,"green") && $num>13)
		{
			$total_sum += $key+1;
			break;
		}else if(str_contains($cube,"blue") && $num>14)
		{
			$total_sum += $key+1;
			break;
		}
	}
}

var_dump(5050-$total_sum);

// Part 2
$total_power = 0;

foreach ($data as $key => $value) {

	$first_split = explode(":", $value);
	$cubes = preg_split( '/[;,]/', $first_split[1] );
	$cubes_array = ["red"=>[],"green"=>[],"blue"=>[]];
	
	foreach ($cubes as $key2 => $cube) {
		preg_match_all('!\d+!', $cube, $matches);
		$num = $matches[0][0];
		if(str_contains($cube,"red"))
		{
			array_push($cubes_array["red"], $num);

		}else if(str_contains($cube,"green"))
		{
			array_push($cubes_array["green"], $num);
		}else if(str_contains($cube,"blue"))
		{
			array_push($cubes_array["blue"], $num);
		}
	}

	$total_power += max($cubes_array["red"])*max($cubes_array["green"])*max($cubes_array["blue"]);
}

var_dump($total_power);