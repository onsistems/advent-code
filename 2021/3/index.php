<?php
// Advent of Code - Day 3

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);



$bin_arr = [];

foreach ($arr_data as $key => $value) {
	for ($i=0; $i < 12; $i++) {
		if($key>0){
			$bin_arr[$i] = $bin_arr[$i].$value[$i];
		}else{
			$bin_arr[$i]=$value[$i];
		}
		
		
	}
}

function getHighest($str){
    $str = str_replace(' ', '', $str);//Trims all the spaces in the string
    $arr = str_split(count_chars($str.trim($str), 3));
    $hStr = "";
    $occ = 0;

    foreach ($arr as $value) {
        $oc = substr_count ($str, $value);
        if($occ < $oc){
            $hStr = $value;
            $occ = $oc;
        }
    }

    return $hStr;
}

$gamma = '';
$epsilon = '';

foreach ($bin_arr as $key => $value) {
	$common = getHighest($value);
	$gamma .= $common;
	$epsilon .= $common=='1'?'0':'1';
}

var_dump($gamma,$epsilon); //1082324

