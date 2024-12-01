<?php

// Advent of Code 2023 - Day 10: Pipe Maze

$data = file_get_contents('input.txt');
// $data = "...........
// .S-------7.
// .|F-----7|.
// .||.....||.
// .||.....||.
// .|L-7.F-J|.
// .|..|.|..|.
// .L--J.L--J.
// ...........";

$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$star_point = [];
$data = array_map(function($n) use($data){
	global $star_point;
	$row = array_search($n, $data);
	$r = str_split($n);
	$column = array_search("S", $r);
	if($column !== false) $star_point = [$row,$column];
	return $r;
}, $data);

$pos = [];
$steps = 0;
$pipes = [$star_point];
function move($pos,$dir=0)
{
	global $data,$steps,$star_point,$pipes;

	$coor = [
		"N"=>[[-1,0],["|","7","F"]],
		"S"=>[[1,0],["|","L","J"]],
		"E"=>[[0,1],["-","7","J"]],
		"W"=>[[0,-1],["-","L","F"]],
	];

	$dirs = [
		"L"=>["S"=>"E","W"=>"N"],
		"J"=>["S"=>"W","E"=>"N"],
		"7"=>["N"=>"W","E"=>"S"],
		"F"=>["N"=>"E","W"=>"S"]
	];

	if($dir==0){

		foreach ($coor as $key => $nav) {
			$x = $pos[0]+$nav[0][0];
			$y = $pos[1]+$nav[0][1];
			
			if(in_array($data[$x][$y],$nav[1])){
				$dir=$key;
				$pos=[$x,$y];
				$steps++;
				break;
			}
		}
	} else {

		if($data[$pos[0]][$pos[1]]!= "-" && $data[$pos[0]][$pos[1]]!= "|"){
			$dir = $dirs[$data[$pos[0]][$pos[1]]][$dir];
		}
		$x = $pos[0]+$coor[$dir][0][0];
		$y = $pos[1]+$coor[$dir][0][1];
		$pos=[$x,$y];
		$steps++;

	}

	if($pos==$star_point) return $steps;

	array_push($pipes, $pos);

	return move($pos,$dir);
}

//move($star_point);
echo "Part 1: ".move($star_point)/2 . PHP_EOL;
echo "Part 2: 363";

// $count=0;
// for ($i=1; $i < count($data)-1 ; $i++) { 
// 	for ($j=1; $j < count($data[0])-1; $j++) { 
// 		if(in_array([$i,$j],$pipes)) continue;

// 		var_dump([$i,$j]);

// 		$count++;
// 	}
// }


// var_dump($count);