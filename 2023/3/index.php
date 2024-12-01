<?php

// Advent of Code 2023 - Day 3: Gear Ratios

$data = file_get_contents('input.txt');
// $data = "467..114..
// ...*......
// ..35..633.
// ......#...
// 617*......
// .....+.58.
// ..592.....
// ......755.
// ...$.*....
// .664.598..";
$data = preg_split("/\r\n|\n|\r/", $data);

$data_map = array_map(fn($n)=>str_split($n), $data);
$numbers = [];
$sum = 0;

foreach ($data as $key => $value) {
	preg_match_all('!\d+!', $value, $matches);
	$matches = $matches[0];

	foreach ($matches as $number) {
		if(!is_numeric($number)){
			var_dump($number);
		}
		$start = strpos($value, $number)-1;
		$finish = $start+strlen($number)+1;
		//var_dump($number);
		//var_dump($number,"S:".$start,"F:".$finish);
		for ($i=$key-1; $i <= $key+1; $i++) { 
			for ($j=$start; $j <= $finish ; $j++) { 
				if(isset($data_map[$i][$j]) && $data_map[$i][$j]!=="." && !is_numeric($data_map[$i][$j]))
				{
					//var_dump($data_map[$i][$j],$i,$j);
					array_push($numbers, (int) $number);
					break 2;
				}
			}
		}
	}
}

var_dump($numbers);

var_dump(array_sum($numbers));