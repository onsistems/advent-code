<?php
// Advent of Code - Day 2

$data = file_get_contents('input.txt');
$arr_number = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);


// Part 1
$depth = 0;
$horizontal = 0;

foreach ($arr_number as $key => $value) {
	$split = explode(" ",$value);
	$num = (int)$split[1];
	if($split[0] == 'forward') {
		$horizontal += $num;
	} else {
		$depth = ($split[0]=='up')?$depth-$num:$depth+$num;
	}
}
echo 'Part 1', PHP_EOL;
echo $depth, PHP_EOL;//1033
echo $horizontal, PHP_EOL;//2053
echo $depth*$horizontal, PHP_EOL, PHP_EOL; //2120749

// Part 2
$depth = 0;
$horizontal = 0;
$aim = 0;

foreach ($arr_number as $key => $value) {
	$split = explode(" ",$value);
	$num = (int)$split[1];
	if($split[0] == 'forward') {
		$horizontal += $num;
		$aim = $aim + ($num*$depth);
	} else {
		$depth = ($split[0]=='up')?$depth-$num:$depth+$num;
	}
}

echo 'Part 2', PHP_EOL;
echo $depth, PHP_EOL;//1033
echo $horizontal, PHP_EOL;//2053
echo $aim, PHP_EOL;//1041589
echo $aim*$horizontal, PHP_EOL; //2138382217