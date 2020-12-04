<?php
// Advent of Code - Day 4

$data = file_get_contents('data.txt');
$arr_field = preg_split('/\n\n/', $data, -1, PREG_SPLIT_NO_EMPTY);

// Part 1
function check_passport($passport){
	$check_code = ['byr','iyr','eyr','hgt','hcl','ecl','pid'];
	$count = preg_match_all('/byr|iyr|eyr|hgt|hcl|ecl|pid/', $passport);
	if($count ==  count($check_code)){
		return $passport;
	}
}
$check_passport = array_filter($arr_field, "check_passport");
var_dump(count($check_passport));

// Part 2
function byr($v){ return ($v>=1920 && $v<=2002); }
function iyr($v){ return ($v>=2010 && $v<=2020); }
function eyr($v){ return ($v>=2020 && $v<=2030); }
function hgt($v){
	if(strpos($v,'cm')!==false){
		return ((int)$v>=150 && (int)$v<=193);
	}
	if(strpos($v,'in')!==false){
		return ((int)$v>=59 && (int)$v<=76);
	}
}
function hcl($v){ return (strlen($v)==7 && preg_match_all('/[0-9]|[a-f]|#/', $v)==7); }
function ecl($v){ return (in_array($v, ['amb','blu','brn','gry','grn','hzl','oth'])); }
function pid($v){ return (strlen((string)$v)==9); }
function map($v){
	return (explode(":", $v));
}
function valid_passport($passport) {
	$valid_code = ['byr','iyr','eyr','hgt','hcl','ecl','pid'];
	$count=0;
	$arr_values = array_map('map',preg_split('/\n|\s/', $passport, -1, PREG_SPLIT_NO_EMPTY));
	foreach ($arr_values as $value) {
		if($value[0]!='cid' && $value[0]($value[1])){
			$count++;
		}
	}
	if($count ==  count($valid_code)){
		return $passport;
	}
}
$valid_passport = array_filter($check_passport, "valid_passport");
var_dump(count($valid_passport));