<?php

// Advent of Code 2023 - Day 4: Scratchcards

$data = file_get_contents('input.txt');
$data = preg_split("/\r\n|\n|\r/", $data);

$scratchcards = array_fill(0, count($data), 1);

$total_sum = 0;
foreach ($data as $key => $value) {
	$slit_value = explode(":", $value);
	$card_values = explode(" | ", $slit_value[1]);
	preg_match_all('!\d+!', $card_values[0], $winners);
	$winners = $winners[0];
	preg_match_all('!\d+!', $card_values[1], $playing);
	$playing = $playing[0];

	$winners_numbers = array_intersect($winners, $playing);
	$count_winners = count($winners_numbers);

	for ($i=0; $i < $scratchcards[$key]; $i++) { 
		for ($j=$key+1; $j <= $key+$count_winners ; $j++) { 
			$scratchcards[$j]++;
		}
	}

	$total_sum += $count_winners==0?0:pow(2, $count_winners-1);
}

var_dump($total_sum); // Part 1
var_dump(array_sum($scratchcards)); // Part 2