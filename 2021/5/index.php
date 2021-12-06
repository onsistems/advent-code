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

	// Part 1
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

	// Part 2
	if(abs((int)$pos1[0]-(int)$pos2[0])==abs((int)$pos1[1]-(int)$pos2[1]))
	{
		$inicio = [(int)$pos1[0],(int)$pos1[1]];
		$fin = [(int)$pos2[0],(int)$pos2[1]];
		$step1 = (int)$pos1[0]-(int)$pos2[0] > 0 ? -1:1;
		$step2 = (int)$pos1[1]-(int)$pos2[1] > 0 ? -1:1;

		while($inicio[0]!=$fin[0] && $inicio[1]!=$fin[1]) {
			if(!isset($hidro_line[$inicio[0].'-'.$inicio[1]])) $hidro_line[$inicio[0].'-'.$inicio[1]]=0;
			$hidro_line[$inicio[0].'-'.$inicio[1]]++;
			$inicio[0] = $inicio[0]+$step1;
			$inicio[1] = $inicio[1]+$step2;
		}
		if(!isset($hidro_line[$inicio[0].'-'.$inicio[1]])) $hidro_line[$inicio[0].'-'.$inicio[1]]=0;
		$hidro_line[$inicio[0].'-'.$inicio[1]]++;
	}

}

$mas_2_lines=0;

foreach ($hidro_line as $key => $value) {
	if($value>=2) $mas_2_lines++;
}

var_dump($mas_2_lines);//7297