<?php

// Advent of Code 2023 - Day 9: Mirage Maintenance

$data = file_get_contents('input.txt');
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$data = array_map(fn($e) => explode(" ", $e),$data);

$last_one =[];
function mirage(array $values): array
{
	global $last_one;

	if(array_sum($values)==0) return $values;

	array_push($last_one, $values[count($values)-1]);
	$sub_values = [];

	for ($i=1; $i < count($values) ; $i++) { 
		array_push($sub_values, $values[$i]-$values[$i-1]);
	}

	return mirage($sub_values);
}

function oasis(array $values): array
{
	global $first_one;

	if(array_sum($values)==0) return $values;

	array_push($first_one, $values[count($values)-1]);
	$sub_values = [];

	for ($i=0; $i < count($values)-1 ; $i++) { 
		array_push($sub_values, $values[$i]-$values[$i+1]);
	}

	return oasis($sub_values);
}


$first = 0;
foreach ($data as $key => $arr_value) {
	$first_one =[];
	mirage($arr_value);
	oasis(array_reverse($arr_value));
	for ($i=0; $i < count($first_one); $i++) { 
		$first += $first_one[$i]*(pow(-1, $i));
	}
	
}

echo "Part 1: ".array_sum($last_one).PHP_EOL;
echo "Part 2: ".$first;