<?php

// Advent of Code 2023 - Day 8: Haunted Wasteland

$data = file_get_contents('input.txt');
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$navegation = "LRLRLRLLRRLRRLRRRLRRLRLLRRRLRRRLRRLLLLRRRLRLLRRLRRLRRLLLRRRLRRRLRRLRLRRLRLRLRLLRRRLRRRLLRRRLRRRLRRRLRLLLRRLRLRRRLRLRRRLLRRRLRLLRLRRRLRLRRRLRRLLRLRLRRLRLRLRRLRLRLRRRLRRLRLLRRLRRRLRRRLRRLRRRLRRLRLRRRLLRRRLLRRLRLRRRLRRRLLRRRLRLRRLRLRLRRLRLLRRLRLRLRRLRRRLRRRLRLRRLRRLLLRRRLLRLRRRLLRRRR";
$node = [];
foreach ($data as $key => $value) {
	preg_match_all('/\w+/', $value, $matches);
	$node[$matches[0][0]]=["L"=>$matches[0][1],"R"=>$matches[0][2]];
}

// Part 1
$pos = "AAA";
$steps = 0;
function find_end($pos,$steps) {
	global $navegation,$node;
	for ($i=0; $i < strlen($navegation) ; $i++) { 
		$direction = $navegation[$i];
		$pos = $node[$pos][$direction];
		$steps++;
		if($pos == "ZZZ")
		{
			break;
		}
	}

	if($pos != "ZZZ") return find_end($pos,$steps);

	return $steps;
}
echo "Part 1: ".find_end($pos,$steps).PHP_EOL;

// Part 2
$endsA = array_filter(array_keys($node),fn($key)=>$key[2]=="A");
function find_end_last($pos,$steps) {
	global $navegation,$node;
	for ($i=0; $i < strlen($navegation) ; $i++) { 
		$direction = $navegation[$i];
		$pos = $node[$pos][$direction];
		$steps++;
		if($pos[2] == "Z")
		{
			break;
		}
	}

	if($pos[2] != "Z") return find_end_last($pos,$steps);

	return $steps;
}

$lcm = 1;
foreach ($endsA as $key => $value) {
	$steps = find_end_last($value,0);
	$lcm = gmp_lcm($steps,$lcm);
}
echo "Part 2: ".$lcm;


