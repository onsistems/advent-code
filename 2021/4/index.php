<?php
// Advent of Code - Day 4
// Part1 - 67716 (board:66,draw:66)
// Part2 - 1830 (board:31,draw:6)

$data = file_get_contents('input.txt');
$arr_data = preg_split('/AAA/', $data, -1, PREG_SPLIT_NO_EMPTY);

$draw_arr=[31,88,35,24,46,48,95,42,18,43,71,32,92,62,97,63,50,2,60,58,74,66,15,87,57,34,14,3,54,93,75,22,45,10,56,12,83,30,8,76,1,78,82,39,98,37,19,26,81,64,55,41,16,4,72,5,52,80,84,67,21,86,23,91,0,68,36,13,44,20,69,40,90,96,27,77,38,49,94,47,9,65,28,59,79,6,29,61,53,11,17,73,99,25,89,51,7,33,85,70];

function inter($n) { return preg_split('/ +/', $n); }

$board_result = function($board,$key_board,$draw)
{
	$board_result[$key_board] = [];
	
	$arr_number = array_map("inter", preg_split('/\n+/', $board, -1, PREG_SPLIT_NO_EMPTY));
	for ($i=0; $i < count($arr_number); $i++) { 
		for ($j=0; $j <count($arr_number[$i]); $j++) { 
			if($arr_number[$i][$j]==$draw)
			{
				return [$i,$j];
			}
		}
	}
};

$winer_boards = [];
foreach ($draw_arr as $key => $value) {
	foreach ($arr_data as $key2 => $value2) {
		

		if (!is_null($board_result($value2,$key,$value))) {
			if(!isset($result[$key2])) $result[$key2] = [[],[]];
			array_push($result[$key2][0],$board_result($value2,$key,$value)[0]);
			array_push($result[$key2][1],$board_result($value2,$key,$value)[1]);
		}
	}
	foreach ($result as $key3 => $value3) {

		$countsX = array_count_values($value3[0]);
		arsort($countsX);
		$top_with_countX = array_slice($countsX, 0, 5, true);
		
		$countsY = array_count_values($value3[1]);
		arsort($countsY);
		$top_with_countY = array_slice($countsY, 0, 5, true);

		
		if(reset($top_with_countX)==5 || reset($top_with_countY)==5){
			if(!in_array($key3, $winer_boards))	array_push($winer_boards, $key3);
			//var_dump($key3,$value,$arr_data[$key3],$value3,$top_with_countX,$top_with_countY);die;//67716 (board:66,draw:66)
		}
	}

	if(count($winer_boards)==100) break;
}
var_dump($winer_boards);
$last_board = array_pop($winer_boards);
var_dump($last_board,$result[$last_board],$arr_data[$last_board]);