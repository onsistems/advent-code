	<?php

	// Advent of Code 2022 - Day 10: Cathode-Ray Tube

	$data = file_get_contents('input.txt');
	$arr_data = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);

	$cycles = 0;
	$signal_strength = 0;
	$x = 1;
	$cycle_strength = 20;
	$sprite = array_fill(0, 40, '.');
	$sprite[0] = $sprite[1] = $sprite[2] = "#";
	$crt = array_fill(0, 6, array_fill(0, 40, '.'));
	$crt_pos = 0;
	$crt_row = 0;

	foreach ($arr_data as $signal) {
		$arr_signal = explode(" ",$signal);

		if($arr_signal[0] == "noop")
		{
			$cycles++;
			check_signal_strength($cycles, $x);
			draw_crt(1, $x, $cycles);
		} else {
			$cycles++;
			check_signal_strength($cycles, $x);

			$cycles++;
			check_signal_strength($cycles, $x);

			$x += (int) $arr_signal[1];
			draw_crt(2, $x, $cycles);
		}
	}

	function check_signal_strength(int $cycles, int $x): void
	{
		global $signal_strength, $cycle_strength;

		if($cycles == $cycle_strength && $cycle_strength<221)
		{
			$signal_strength += $cycles * $x;
			$cycle_strength += 40;
		}
	}

	function draw_crt(int $pixel, int $x,int $cycles): void
	{
		global $sprite, $crt, $crt_pos, $crt_row;

		if($pixel == 1)
		{
			$crt[$crt_row][$crt_pos] = $sprite[$crt_pos];
			$crt_pos++;
			if($crt_pos == 40)
			{
				$crt_row++;
				$crt_pos = 0;
			}
			
		} else {
			$crt[$crt_row][$crt_pos] = $sprite[$crt_pos];
			$crt_pos++;
			if($crt_pos == 40)
			{
				$crt_row++;
				$crt_pos = 0;
			}
			
			$crt[$crt_row][$crt_pos] = $sprite[$crt_pos];
			$crt_pos++;
			if($crt_pos == 40)
			{
				$crt_row++;
				$crt_pos = 0;
			}
			
			$sprite = array_fill(0, 40, '.');
			$sprite[$x-1] = $sprite[$x] = $sprite[$x+1] = "#";
		}	
	}

	var_dump($signal_strength); // 14040
	$crt_str = "";
	foreach ($crt as $row) {
		foreach ($row as $pixel) {
			$crt_str .= $pixel;
		}
		$crt_str .= PHP_EOL;
	}

	echo $crt_str; // ZGCJZJFL