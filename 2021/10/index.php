<?php
// Advent of Code - Day 10

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

$level = 0;
$open_brackets = ["(","[","{","<"];
$close_brackets = [")","]","}",">"];
$price_brackets = ["-"=>0,")"=>3,"]"=>57,"}"=>1197,">"=>25137];
$price_close = ["-"=>0,")"=>1,"]"=>2,"}"=>3,">"=>4];

function check_brackets($brackets) 
{
	global $open_brackets, $close_brackets,$price_close;
	$opens = [];
	$invalid_char = "-";
	$arr_brackets = str_split($brackets);
	foreach($arr_brackets as $key =>$char){
		if(in_array($char, $open_brackets)){
			array_push($opens, $char);
		}

		if(in_array($char, $close_brackets)){
			if(empty($opens)){
				$invalid_char = $char;
				break;
			}
			$pos = array_search($char, $close_brackets);
			if($opens[count($opens)-1] == $open_brackets[$pos]){
				array_pop($opens);
			} else {
				$invalid_char = $char;
				break;
			}
		}
	}
	
	$close_points = 0;
	if($invalid_char == "-"){
		$reversed_opens = array_reverse($opens);
		foreach ($reversed_opens as $key => $value) {
			$pos = array_search($value, $open_brackets);
			$close_points = $close_points*5 + $price_close[$close_brackets[$pos]];
		}

	}
	return [$invalid_char,$close_points];
}

$total_points = 0;
$close_points_arr = [];
foreach ($arr_data as $key => $brackets) {
	[$invalid_char,$close_points] = check_brackets($brackets);
	$total_points = $total_points + $price_brackets[$invalid_char];
	if($close_points!=0) array_push($close_points_arr, $close_points);
}

echo "Part 1: ".$total_points,PHP_EOL;

sort($close_points_arr);
$middle  = count($close_points_arr)/2;
$pos_close = floor($middle);

echo "Part 2: ".$close_points_arr[$pos_close];
