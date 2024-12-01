<?php

// Advent of Code 2023 - Day 5: If You Give A Seed A Fertilizer
ini_set('memory_limit', '-1');
$data = file_get_contents('input.txt');

// $data = "seeds: 79 14 55 13

// seed-to-soil map:
// 50 98 2
// 52 50 48

// soil-to-fertilizer map:
// 0 15 37
// 37 52 2
// 39 0 15

// fertilizer-to-water map:
// 49 53 8
// 0 11 42
// 42 0 7
// 57 7 4

// water-to-light map:
// 88 18 7
// 18 25 70

// light-to-temperature map:
// 45 77 23
// 81 45 19
// 68 64 13

// temperature-to-humidity map:
// 0 69 1
// 1 0 69

// humidity-to-location map:
// 60 56 37
// 56 93 4";

$data = preg_split("/(\n){2,}|(\r\n){2,}/", $data);
preg_match_all('!\d+!', $data[0], $seeds);
$seeds_1 = $seeds[0];
array_shift($data);

$seeds_2 = array_merge(range($seeds_1[0], $seeds_1[0]+$seeds_1[1]) 	,range($seeds_1[2], $seeds_1[2]+$seeds_1[3]));


$map_names = ["soil","fertilizer","water","light","temperature","humidity","location"];

function lowest_location(array $seeds):int
{
	global $data;
	foreach ($data as $key => $value) {
		$value = preg_split("/\r\n|\n|\r/", $value);
		array_shift($value);
		foreach ($seeds as $seed_key => $seed_value) {
			foreach ($value as $cords) {
				//var_dump($map_names[$key],$cords);
				preg_match_all('!\d+!', $cords, $points);
				$points = $points[0];//0-destination,1-origin,2-step
			
				if($seed_value>=$points[1] && $seed_value<$points[1]+$points[2]){
					$seeds[$seed_key] = $points[0]+($seed_value-$points[1]);
					break;
				}
			}
		}
		//var_dump($map_names[$key],($seeds));
	}

	return min($seeds);
}

//var_dump(lowest_location($seeds_1)); // Part 1
var_dump(lowest_location($seeds_2)); // Part 1