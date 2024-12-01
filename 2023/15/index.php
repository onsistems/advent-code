<?php

// Advent of Code 2023 - Day 15: Lens Library

$data = file_get_contents('input.txt');
//$data = "rn=1,cm-,qp=3,cm=2,qp-,pc=4,ot=9,ab=5,pc-,pc=6,ot=7";
$data = explode(",", $data);

function hash_ascii(string $str): int
{
	$arr_str = str_split($str);
	$hash = 0;
	foreach ($arr_str as $key => $char) {
		$hash += ord($char);
		$hash *= 17;
		$hash = $hash%256;
	}
	return $hash;
}

$library = [];
$total = 0;
foreach ($data as $key => $string) {
	
	if(str_contains($string, "="))
	{
		list($key,$focus) = explode("=", $string);
		$library[hash_ascii($key)][$key] = $focus;
	} else if(str_contains($string, "-"))
	{
		$key = str_replace("-", "", $string);
		unset($library[hash_ascii($key)][$key]);
		
	}

	$total += hash_ascii($string);
}
echo "Part 1: ".$total.PHP_EOL;

$total2 = 0;
foreach ($library as $box => $lens) {
	$count = 1;
	foreach ($lens as $key => $focus) {
		$total2 += ($box+1)*$count*$focus;
		$count++;
	}
}
echo "Part 2: ".$total2.PHP_EOL;