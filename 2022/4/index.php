<?php

// Advent of Code 2022 - Day 4: Camp Cleanup

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);
$count_fully_contains = 0;
$count_overlap = 0;

foreach ($arr_data as $data) {
	$split1 = explode(',',$data);
	$split11 = explode('-',$split1[0]);
	$split12 = explode('-',$split1[1]);

	$a1 = range($split11[0],$split11[1]);
	$a2 = range($split12[0],$split12[1]);
	$b1 = array_diff($a1, $a2);
	$b2 = array_diff($a2, $a1);
 	$c  = array_intersect($a1,$a2);

	$count_fully_contains += empty($b1)||empty($b2)?1:0;
	$count_overlap += !empty($c)?1:0;
}


var_dump($count_fully_contains); //542
var_dump($count_overlap); //900