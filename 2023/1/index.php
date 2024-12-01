<?php

// Advent of Code 2023 - Day 1: Trebuchet?!

$data = file_get_contents('input.txt');
$data = preg_split("/\r\n|\n|\r/", $data);

// Part 1
$total_sum = 0;
foreach ($data as $key => $value) {
	$int_var = '';
	$int_var = preg_replace('/[^0-9]/', '', $value);
	$total_sum += $int_var[0].$int_var[strlen($int_var)-1];
}

var_dump($total_sum);

// Part 2
$total_sum = 0;
$search  = array('one', 'two', 'three', 'four', 'five','six','seven','eight','nine');
$replace = array('one1one', 'two2two', 'three3three', 'four4four', 'five5five','six6six','seven7seven','eight8eight','nine9nine');
foreach ($data as $key => $value) {
	$int_var = '';
	$value = str_replace($search, $replace, $value);
	$int_var = preg_replace('/[^0-9]/', '', $value);
	$total_sum += $int_var[0].$int_var[strlen($int_var)-1];
}

var_dump($total_sum);
