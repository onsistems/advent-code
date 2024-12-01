<?php

// Advent of Code 2022 - Day 5: Supply Stacks

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);
$arr_cargo_1 = $arr_cargo_2 = [
	1=>["T","F","V","Z","C","W","S","Q"],
	2=>["B","R","Q"],
	3=>["S","M","P","Q","T","Z","B"],
	4=>["H","Q","R","F","V","D"],
	5=>["P","T","S","B","D","L","G","J"],
	6=>["Z","T","R","W"],
	7=>["J","R","F","S","N","M","Q","H"],
	8=>["W","H","F","N","R"],
	9=>["B","R","P","Q","T","Z","J"]
];


// Get number from the order
function set_orders(string $order)
{
	preg_match_all('!\d+!', $order, $matches);
	return call_user_func_array('array_merge',$matches);
}

foreach ($arr_data as $data) {
	$arr_orders = set_orders($data);

	$n1 = array_splice($arr_cargo_1[$arr_orders[1]], $arr_orders[0]);
	$n2 = array_splice($arr_cargo_2[$arr_orders[1]], $arr_orders[0]);
	
	[$n1,$arr_cargo_1[$arr_orders[1]]] = [$arr_cargo_1[$arr_orders[1]],$n1];
	[$n2,$arr_cargo_2[$arr_orders[1]]] = [$arr_cargo_2[$arr_orders[1]],$n2];

	$arr_cargo_1[$arr_orders[2]] = array_merge(array_reverse($n1),$arr_cargo_1[$arr_orders[2]]);
	$arr_cargo_2[$arr_orders[2]] = array_merge($n2,$arr_cargo_2[$arr_orders[2]]);
}

$result1 = array_map(function($element){
	return $element[0];
}, $arr_cargo_1);

$result2 = array_map(function($element){
	return $element[0];
}, $arr_cargo_2);

var_dump(implode("",$result1)); // BZLVHBWQF
var_dump(implode("",$result2)); // TDGJQTZSL