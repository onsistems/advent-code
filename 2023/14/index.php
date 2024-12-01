<?php

// Advent of Code 2023 - Day 14: Parabolic Reflector Dish
// A veces para hacer las columnas no has que hacer las traspuesta de la matriz sino recorrer al reves, primero columnas y luego filas
// Con procesos extremadamente largo unas una cache, vemos cuando se repite y paramos

$data = file_get_contents('input.txt');
$data ="O....#....
O.OO#....#
.....##...
OO.#O....O
.O.....O#.
O.#..O.#.#
..O..#O..O
.......O..
#....###..
#OO..#....";
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$data = array_map(fn($e)=>str_split($e), $data);
//var_dump($data);die;


function foo(&$var)
{
    $var++;
}

$a=5;
foo($a);
var_dump("{$a},{$a};");die;

function move_rocks_north(array $map):array
{
	for ($c=0; $c < count($map[0]); $c++) {
		$empty = [];
		for ($r=0; $r < count($map); $r++) { 
			if($map[$r][$c]=="."&& count($empty)==0)
			{
				$empty = [$r,$c];
			}
			else if($map[$r][$c]=="O" && count($empty)>0){
				if($empty!=[$r,$c]){
					$map[$empty[0]][$empty[1]]="O";
					$map[$r][$c]=".";
				}
				$empty = [$empty[0]+1,$empty[1]];
			} else if($map[$r][$c]=="#" && count($empty)>0)
			{
				$empty = [$r+1,$c];
			}
		}
	}
	return $map;
}
function move_rocks_west(array $map):array
{
	for ($r=0; $r < count($map); $r++) {
		$empty = [];
		for ($c=0; $c < count($map[0]); $c++) { 
			if($map[$r][$c]=="."&& count($empty)==0)
			{
				$empty = [$r,$c];
			}
			else if($map[$r][$c]=="O" && count($empty)>0){
				if($empty!=[$r,$c]){
					$map[$empty[0]][$empty[1]]="O";
					$map[$r][$c]=".";
				}
				$empty = [$empty[0],$empty[1]+1];
			} else if($map[$r][$c]=="#" && count($empty)>0)
			{
				$empty = [$r,$c+1];
			}
		}
	}
	return $map;
}
function move_rocks_south(array $map):array
{
	for ($c=0; $c < count($map[0]); $c++) {
		$empty = [];
		for ($r=count($map)-1; $r >= 0; $r--) { 
			if($map[$r][$c]=="."&& count($empty)==0)
			{
				$empty = [$r,$c];
			}
			else if($map[$r][$c]=="O" && count($empty)>0){
				if($empty!=[$r,$c]){
					$map[$empty[0]][$empty[1]]="O";
					$map[$r][$c]=".";
				}
				$empty = [$empty[0]-1,$empty[1]];
			} else if($map[$r][$c]=="#" && count($empty)>0)
			{
				$empty = [$r-1,$c];
			}
		}
	}
	return $map;
}

function move_rocks_east(array $map):array
{
	for ($r=0; $r < count($map); $r++) {
		$empty = [];
		for ($c=count($map[0])-1; $c >= 0; $c--) { 
			if($map[$r][$c]=="."&& count($empty)==0)
			{
				$empty = [$r,$c];
			}
			else if($map[$r][$c]=="O" && count($empty)>0){
				if($empty!=[$r,$c]){
					$map[$empty[0]][$empty[1]]="O";
					$map[$r][$c]=".";
				}
				$empty = [$empty[0],$empty[1]-1];
			} else if($map[$r][$c]=="#" && count($empty)>0)
			{
				$empty = [$r,$c-1];
			}
		}
	}
	return $map;
}
for ($i=0; $i < 1000000000 ; $i++) { 
	$data = move_rocks_north($data);
	$data = move_rocks_west($data);
	$data = move_rocks_south($data);
	$data = move_rocks_east($data);
}
// $data = move_rocks_north($data);
// $data = move_rocks_west($data);
// $data = move_rocks_south($data);
// $data = move_rocks_east($data);
// $data = array_map(fn($e)=>implode("", $e), $data);
// var_dump($data);die;
$total = 0;
foreach ($data as $key => $value) {
	$count_values = array_count_values($value);
	if(!isset($count_values["O"])) $count_values["O"]=0;
	$total += (count($data)-$key)*$count_values["O"];
}

//echo "Part 1: ".$total.PHP_EOL;

var_dump($total);