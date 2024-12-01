<?php

// Advent of Code 2023 - Day 17: Clumsy Crucible
$data = file_get_contents('input.txt');
$data = "2413432311323
3215453535623
3255245654254
3446585845452
4546657867536
1438598798454
4457876987766
3637877979653
4654967986887
4564679986453
1224686865563
2546548887735
4322674655533";
$data = trim($data);
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$data = array_map(fn($e)=>str_split($e), $data);

$maxR = count($data);
$maxC = count($data[0]);
$start = [0,0];
$finish = [$maxR,$maxC];
$seen = [];
const COMPAS = ["N"=>[-1,0],"S"=>[1,0],"E"=>[0,1],"W"=>[0,-1]];

function next_block(array $current):array
{
	global $data,$seen,$total_lost;
	$next = ["N"=>0,"S"=>0,"E"=>0,"W"=>0];

	foreach ($next as $key => $value) {
		for ($i=1; $i <=4; $i++) { 
			$x = $current[0]+COMPAS[$key][0]*$i;
			$y = $current[1]+COMPAS[$key][1]*$i;
			if(isset($data[$x][$y]) && !in_array([$x,$y], $seen))
			{
				$next[$key] += $data[$x][$y];
			}
		}
		
	}

	$pos = array_search(min(array_filter($next)), $next);
	var_dump($pos,$next);
	return [$current[0]+COMPAS[$pos][0],$current[1]+COMPAS[$pos][1]];
	
}

$total_lost = 0;
$current = $start;
$count = 0;
//var_dump($current);
while ($current != $finish) {
	$total_lost += $data[$current[0]][$current[1]];
	$seen[] = $current;
	$current = next_block($current);
	$count++;
	var_dump($current);

	if($count==4) die;
}

echo $total_lost;