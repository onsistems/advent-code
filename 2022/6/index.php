<?php

// Advent of Code 2022 - Day 6: Tuning Trouble

$data = file_get_contents('input.txt');
$data = str_split($data);

function marker(int $size)
{
	global $data;

	for ($i=0; $i < count($data); $i++) { 
		
		$marker = [];
		for ($j=0; $j < $size; $j++) { 
			array_push($marker, $data[$i+$j]);
		}

		if(count(array_count_values($marker)) == $size)
		{
			$marker_pos = $i+$size;
			break;
		}
	}

	return [$marker,$marker_pos];
}

[$marker1,$marker_pos_1] = marker(4);
[$marker2,$marker_pos_2] = marker(14);

var_dump(implode($marker1),$marker_pos_1); // 1210 - qgds
var_dump(implode($marker2),$marker_pos_2); // 3476 - qslcnmfvwtpdbj