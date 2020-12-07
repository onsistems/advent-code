<?php
// Advent of Code - Day 5

$data = file_get_contents('data.txt');
$arr_bags = preg_split('/\n/', $data, -1, PREG_SPLIT_NO_EMPTY);

// Part1
function container($main, $second){
	$cont = [];
	$aux = false;
	foreach ($main as $bags) {
		foreach ($second as $search) {
			if(stripos($bags, " ".$search." ") !== false){
				array_push($cont, $bags);
				$arr = explode(" ", $bags);
				array_push($second, implode(" ", [$arr[0], $arr[1]]));
				$aux = true;
			}
		}
	}
	$main = array_diff($main,$cont);
	if($aux){
		$second = container($main, $second);
	}
	return $second;
}
$sec = container($arr_bags,["shiny gold"]);
var_dump(count(array_unique($sec))-1);

// Part2
function container2($main, $power = []){
	foreach ($main as $bag) {
		if(stripos($bag, "other") !== false){
			$arr = explode(" ", $bag);
			$power[$arr[0]." ".$arr[1]] = 0;
		} else {
			$pow = 0;
			$arr = explode(" contain ", $bag);
			$arr2 = explode(" ", $bag);
			$mini_bagas = explode(", ", $arr[1]);
			foreach($mini_bagas as $mg){
				$num = intval($mg);
				$arr_mg = explode(" ",$mg);
				if(isset($power[$arr_mg[1]." ".$arr_mg[2]])){
					$pow += $num + $num*$power[$arr_mg[1]." ".$arr_mg[2]];
					$power[$arr2[0]." ".$arr2[1]] = $pow;
				}
			}
		}
	}
	if(count($power) != count($main)){
		$power = container2($main,$power);
	}
	return $power;
}
$sec = container2($arr_bags);
var_dump($sec["shiny gold"]);


