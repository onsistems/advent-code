<?php

// Advent of Code 2023 - Day 16: The Floor Will Be Lava
/**
 * | : 0 si N, S; 1 si W, E
 * - : 1 si N, S; 0 si W, E
 * / : E-N, W-S
 * \ : S-E, N-W                                                                                                     
 */
$data = file_get_contents('test.txt');
$data = trim($data);
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);


const COMPAS = ["N"=>[-1,0],"S"=>[1,0],"E"=>[0,1],"W"=>[0,-1]];
const mirrors = ["/"=>["E"=>"N","N"=>"E","W"=>"S","S"=>"W"],"\\"=>["E"=>"S","S"=>"E","W"=>"N","N"=>"W"]];
$limitX = count($data);
$limitY = strlen($data[0]);

function move($x,$y,$d)
{
	return [$x+COMPAS[$d][0],$y+COMPAS[$d][1],$d];
}

$visit = [[0,0]];

function energized(array $tiles)
{
	global $visit,$data,$limitX,$limitY;
	$arr_tiles = [];

	foreach ($tiles as $key => $tile) {
		list($x,$y,$d) = move($tile[0],$tile[1],$tile[2]);

		//var_dump($x,$y,$d);

		if($x>=0 && $x<$limitX && $y>=0 && $y<$limitY)
		{
			//var_dump("entrot");
			if(!in_array([$x,$y],$visit)) $visit[]=[$x,$y];

			switch ($data[$x][$y]) {
				case '/':
					$arr_tiles[]=[$x,$y,mirrors['/'][$d]];
					break;
				case '\\':
					$arr_tiles[]=[$x,$y,mirrors['\\'][$d]];
					break;
				case '-':
					if(in_array($d, ["E","W"]))
						$arr_tiles[] = [$x,$y,$d];
					else
						$arr_tiles[] = [$x,$y,"E"];
						$arr_tiles[] = [$x,$y,"W"];
					break;
				case '|':
					if(in_array($d, ["N","S"]))
						$arr_tiles[] = [$x,$y,$d];
					else
						$arr_tiles[] = [$x,$y,"N"];
						$arr_tiles[] = [$x,$y,"S"];
					break;
				default:
					$arr_tiles[] = [$x,$y,$d];
					break;
			}
		}
		//var_dump($arr_tiles);
	}

	if(count($arr_tiles)>0) return energized($arr_tiles);

	return [];
}

energized([[0,0,"E"]]);

echo count($visit);


