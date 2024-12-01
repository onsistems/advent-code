<?php

// Advent of Code 2022 - Day 9: Rope Bridge

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

$head = [0,0];
$tail = [0,0];
$knots = [$head,[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0],[0,0]];

$visit = ["part1"=>[],"part2"=>[]];
foreach ($arr_data as $move) {
	$arr_move = explode(" ",$move);
	$step = (int) $arr_move[1];
	
	for ($i=1; $i <= $step ; $i++) { 
		switch ($arr_move[0]) {
			case 'R':
				$head[1]++;
				break;
			case 'L':
				$head[1]--;
				break;
			case 'U':
				$head[0]--;
				break;
			case 'D':
				$head[0]++;
				break;
			default:
				$head;
				break;
		}
		$tail = check_tail($head,$tail,$arr_move[0]);
		if(!in_array($tail, $visit['part1'])) array_push($visit['part1'], $tail);
		
		
		$knots[0] = $head;
		for ($j=1; $j < count($knots) ; $j++) { 

			$knots[$j] = check_tail($knots[$j-1],$knots[$j],$arr_move[0]);
		}
		//var_dump($head);
		if(!in_array($knots[9], $visit['part2'])) array_push($visit['part2'], $knots[9]);
	}
}

function check_tail(array $head, array $tail, string $type): array
{
	if(abs($head[0]-$tail[0])>1)
	{
		$tail[0] = $type=="U"?$head[0]+1:$head[0]-1;
		$tail[1] = $head[1];
	}

	if(abs($head[1]-$tail[1])>1)
	{
		$tail[0] = $head[0];
		$tail[1] = $type=="L"?$head[1]+1:$head[1]-1;
	}

	return $tail;
}
var_dump(count($visit['part1'])); //6236
var_dump(($knots)); //6236