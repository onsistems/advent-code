<?php
// Advent of Code - Day 5

$data = file_get_contents('input.txt');
$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

//var_dump($arr_data);

$hidro_line=[];
foreach ($arr_data as $key => $value) {
	$split1 = explode(" -> ", $value);
	$pos1 = explode(',',$split1[0]);
	$pos2 = explode(',',$split1[1]);

	if($pos1[0]==$pos2[0])
	{
		$inicio = (int)$pos1[1];
		$fin = (int)$pos2[1];
		$step = $pos1[0];
		for ($i=min($inicio,$fin); $i <= max($inicio,$fin); $i++) { 
			if(!isset($hidro_line[$step.'-'.$i])) $hidro_line[$step.'-'.$i]=0;
			$hidro_line[$step.'-'.$i]++;
		}
	}

	if($pos1[1]==$pos2[1])
	{
		$inicio = (int)$pos1[0];
		$fin = (int)$pos2[0];
		$step = $pos1[1];
		for ($j=min($inicio,$fin); $j <= max($inicio,$fin); $j++) { 
			if(!isset($hidro_line[$j.'-'.$step])) $hidro_line[$j.'-'.$step]=0;
			$hidro_line[$j.'-'.$step]++;
		}
	}

	//var_dump($pos1,$pos2);die;
}

$mas_2_lines=0;

foreach ($hidro_line as $key => $value) {
	if($value>=2) $mas_2_lines++;
}

var_dump($mas_2_lines);