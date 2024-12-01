<?php

$data = "Time:        38     94     79     70
Distance:   241   1549   1074   1091";
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
preg_match_all('!\d+!', $data[0], $times);
$times = $times[0];
preg_match_all('!\d+!', $data[1], $distances);
$distances = $distances[0];

// Part 1
$beated_records=array_fill(0, count($times), 0);
foreach ($times as $key => $time) {
	for ($i=1; $i < $time; $i++) { 
		$calc_distance = ($time-$i)*$i;
		if($calc_distance>$distances[$key])
		{
			$beated_records[$key]++;
		}
	}
}
var_dump(array_product($beated_records));

// Part 2
$one_time = implode("", $times);
$one_distance = implode("", $distances);

$beated_record=0;
for ($i=1; $i < $one_time; $i++) { 
	$calc_distance = ($one_time-$i)*$i;
	if($calc_distance>$one_distance)
	{
		$beated_record++;
	}
}
var_dump($beated_record);