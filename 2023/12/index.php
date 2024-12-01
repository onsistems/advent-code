<?php

// Advent of Code 2023 - Day 12: Hot Springs

$data = file_get_contents('input.txt');
$data = "???.### 1,1,3";
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$data = array_map(fn($e)=>explode(" ", $e), $data);

//var_dump($data);

function contar($config,$num)
{
	
	if($config == "")
	{
		return count($num)==0?1:0;
	}

	if(count($num)==0)
	{
		return str_contains($config,"#")?0:1;
	}

	$result = 0;

	if(str_contains(".?", $config[0]))
	{
		$result += contar(substr($config, 1),$num);
	}

	if(str_contains("#?", $config[0]))
	{
		$config2 = $config;
		if($num[0]<= strlen($config) && !str_contains(substr($config2, 0, $num[0]), ".") && ($num[0]==strlen($config) || $config[$num[0]]!="#") )
		{
			$n = array_shift($num);
			$result += contar(substr($config, 0,$n+1),$num);
		} 
	}
var_dump($config,$num);
	return $result;
}

$total = 0;
var_dump($data);
foreach ($data as $key => $value) {
	list($config,$num) = $value;
	$num = explode(",",$num);

	$total += contar($config,$num);
}

echo $total;