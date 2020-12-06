<?php
// Advent of Code - Day 6

$data = file_get_contents('data.txt');
$arr_questions = preg_split('/\n\n/', $data, -1, PREG_SPLIT_NO_EMPTY);

// Part 1
function yes_number($questions){
	preg_match_all('/[a-z]|#/', $questions, $match);
	return count(array_unique($match[0]));
}
var_dump(array_sum(array_map('yes_number', $arr_questions)));

// Part 2
function split_string($string){
	return str_split($string);
}
function all_yes($questions){
	$arr_question = array_map('split_string', preg_split('/\n/', $questions, -1, PREG_SPLIT_NO_EMPTY));
	if(count($arr_question)==1){
		return count($arr_question[0]);
	}
	return count(call_user_func_array('array_intersect',$arr_question));
}
var_dump(array_sum(array_map('all_yes', $arr_questions)));