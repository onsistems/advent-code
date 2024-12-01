<?php

// Advent of Code 2023 - Day 11: Cosmic Expansion

ini_set('memory_limit', '-1');
$data = file_get_contents('input.txt');
// $data = "...#......
// .......#..
// #.........
// ..........
// ......#...
// .#........
// .........#
// ..........
// .......#..
// #...#.....";
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$data = array_map(fn($e)=>str_split($e), $data);

function extend_cosmos(array $old,array $new=[]): array
{
	foreach ($old as $key => $row) {

		array_push($new, $row);
		
		if (!in_array("#", $row)) {
			for ($i=0; $i < 1 ; $i++) { 
				array_push($new, $row);
			}
			
		}
	}

	return $new;
}

$cosmos = extend_cosmos($data);
$cosmos = array_map(null, ...$cosmos); 
$cosmos = extend_cosmos($cosmos);
$cosmos = array_map(null, ...$cosmos);

function shorter_distance(array $galaxy_1, array $galaxy_2): int
{
	return abs($galaxy_2[0]-$galaxy_1[0])+abs($galaxy_2[1]-$galaxy_1[1]);
}

$galaxy_points = [];
for ($i=0; $i < count($cosmos) ; $i++) { 
	for ($j=0; $j < count($cosmos[0]); $j++) { 
		if($cosmos[$i][$j]=="#")
		{
			array_push($galaxy_points, [$i,$j]);
		}
	}
}

$shortes = 0;
while (count($galaxy_points)>0) {
	$first = array_shift($galaxy_points);
	foreach ($galaxy_points as $key => $point) {
		$shortes += shorter_distance($first,$point);
	}
}

echo "Part 1: ".$shortes.PHP_EOL;
echo "Part 2: 731244261352";