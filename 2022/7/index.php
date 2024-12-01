<?php

// Advent of Code 2022 - Day 7: No Space Left On Device

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);
$dir = "";
$arr_dir = [];

foreach ($arr_data as $value) {
	if($value == '$ ls' || $value == "$ cd ..") continue;
	$arr_values = explode(' ',$value);
	
	if(count($arr_values)==3)
	{
		$dir = $arr_values[2];
		
		if(isset($arr_dir[$dir]))
		{
			[$dir,$dir_unset] = [$arr_dir[$dir],$dir];
			unset($arr_dir[$dir_unset]);
		}
		array_push($arr_dir, $dir);
		$store[$dir]=[];
	} else {
		if($arr_values[0] == "dir")
		{
			if(in_array($arr_values[1], $arr_dir))
			{
				$value = "dir ".$dir.'-'.$arr_values[1];
				$arr_dir[$arr_values[1]]=$dir.'-'.$arr_values[1];
			}
		}
		array_push($store[$dir], $value);
	}
	
}



function folder_size(array $folder): int
{
	global $store;
	$size = 0;
	foreach ($folder as $file) {
		[$number,$name] = explode(" ",$file);

		if($number == "dir")
		{
			$number = folder_size($store[$name]);
		}

		$size += (int) $number;

	}
	
	return $size;
}


$store_size = array_map('folder_size', $store);
$store_filter = array_filter($store_size, fn($f) => $f<=100000 ); 

$needed_space = $store_size['/']-40000000;
$store_delete = array_filter($store_size, fn($f) => $f>=$needed_space);
var_dump(array_sum($store_filter)); //1367870
var_dump(min($store_delete)); // FAIL (X: 790752. V: 549173)