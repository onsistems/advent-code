<?php

// Advent of Code 2022 - Day 2: Rock Paper Scissors

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

// This include the Part1 [0] and Part2 [1] scores
$arr_score = [
	"B X" => [1,1],
	"C Y" => [2,6],
	"A Z" => [3,8],
	"A X" => [4,3],
	"B Y" => [5,5],
	"C Z" => [6,7],
	"C X" => [7,2],
	"A Y" => [8,4],
	"B Z" => [9,9]
];

$total_score_1 = 0;
$total_score_2 = 0;

foreach ($arr_data as $key => $value) {
	$total_score_1 += $arr_score[$value][0];
	$total_score_2 += $arr_score[$value][1];
}

var_dump($total_score_1); //13675
var_dump($total_score_2); //14184