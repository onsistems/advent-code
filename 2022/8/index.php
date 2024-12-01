<?php

// Advent of Code 2022 - Day 8: Treetop Tree House

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

$arr_data = array_map(fn($e)=>str_split($e), $arr_data);

$visible_trees = 0;
$edge = [0, count($arr_data)-1];
$scenic_score_arr = [];


for ($i=0; $i < count($arr_data); $i++) { 
	for ($j=0; $j < count($arr_data); $j++) { 
		if(in_array($i, $edge) || in_array($j, $edge))
		{
			$visible_trees++;
		}
		else 
		{
			$scenic_score = 1;

			$column = array_column($arr_data, $j);
			$column_1 = array_slice($column,0, $i);
			$column_2 = array_slice($column,-(count($arr_data)-$i-1));
		
			$row = $arr_data[$i];
			$row_1 = array_slice($row,0,$j);
			$row_2 = array_slice($row,-(count($arr_data)-$j-1));

			$neighbourwoods = [max($column_1),max($column_2),max($row_1),max($row_2)];
			$scenic = [array_reverse($column_1),$column_2,array_reverse($row_1),$row_2];

			// Part 1
			foreach ($neighbourwoods as $tall) {
				if($arr_data[$i][$j] > $tall){
					$visible_trees++;
					break;
				}
			}

			// Part 2
			foreach ($scenic as $trees) {
				$score = 0;
				foreach ($trees as $tree) {
					if($tree>=$arr_data[$i][$j]){
						$score++;
						break;
					}else{
						$score++;
					}
				}
				$scenic_score *= $score;
			}
			$scenic_score_arr[$i.$j] = $scenic_score;
		}
	}
}

var_dump($visible_trees); //1763
var_dump(max($scenic_score_arr)); //671160