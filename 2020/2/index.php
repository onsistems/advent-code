<?php
// Advent of Code - Day 2

$data = file_get_contents('data.txt');
function clean_password($messy_password){
	$first_explode = explode(": ", $messy_password);
	$second_explode = explode(" ", $first_explode[0]);
	$third_explode = explode("-",$second_explode[0]);

	return [
		"text"=> $first_explode[1],
		"char"=> $second_explode[1],
		"min"=> (int)$third_explode[0],
		"max"=> (int)$third_explode[1]
	];
}
$arr_password = array_map("clean_password", preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY));

// Part 1
function check_correct_password($password){
	$count_char = substr_count($password["text"], $password["char"]);
	if ($count_char >= $password["min"] && $count_char <= $password["max"]){
		return true;
	}
	return false;
}

$count_correct_passwords = 0;
foreach ($arr_password as $password) {
	if(check_correct_password($password)){
		$count_correct_passwords++;
	}
}
echo $count_correct_passwords."\n";

// Part 2
function possition_correct_password($password){
	$poss_1 = $password["text"][$password["min"]-1];
	$poss_2 = $password["text"][$password["max"]-1];
	if($poss_1 == $password["char"] && $poss_2 != $password["char"]){
		return true;
	}
	if($poss_1 != $password["char"] && $poss_2 == $password["char"]){
		return true;
	}
	return false;
}

$count_correct_passwords = 0;
foreach ($arr_password as $password) {
	if(possition_correct_password($password)){
		$count_correct_passwords++;
	}
}
echo $count_correct_passwords;