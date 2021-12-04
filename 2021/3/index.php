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

oxigen($arr_data,0);

function oxigen($arr,$step,$most="1")
{
	var_dump(count($arr));
	if(count($arr) == 1){
		$bin_oxigen = $arr[0];
		echo $bin_oxigen;
	}

	if(count($arr)==2){
		var_dump($arr);
		$bin_oxigen = $arr[0][$step]=="1"?$arr[0]:$arr[1];
		echo $bin_oxigen;
	}

	$new_arr=[];
	if(count($arr)>2){
		foreach ($arr as $key => $value) {
			if($value[$step]==$most){
				array_push($new_arr, $value);
			}
		}
		$bin_arr = [];
		foreach ($new_arr as $key => $value) {
			for ($i=0; $i < 12; $i++) {
				if($key>0){
					$bin_arr[$i] = $bin_arr[$i].$value[$i];
				}else{
					$bin_arr[$i]=$value[$i];
				}	
			}
		}	
		$common = getHighest($bin_arr[$step+1]);
		//$common = $common=='1'?'0':'1';

		oxigen($new_arr,$step+1,$common);
	}

	//111001101101 {3693}
	//010011111000 {1272}
}

