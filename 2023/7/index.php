<?php

$data = file_get_contents('input.txt');
// $data = "9A35J 469
// 75T32 237
// 6T8JQ 427
// 3366A 814
// K2AK9 982
// J8KTT 9
// 94936 970
// Q8AK9 15
// 3QQ32 940
// 65555 484";
$data = preg_split("/(\n){1,}|(\r\n){1,}/", $data);
$hands = [];
foreach ($data as $key => $value) {
	$split = explode(" ",$value);
	$hands[$split[1]]=$split[0];
}

$card_values = array_reverse(array("A", "K", "Q", "T", 9, 8, 7, 6, 5, 4, 3, 2, "J"));

$ranked_hand = [];

function type_hand(string $hand):int 
{
	$arr_hand = str_split($hand);
	$count_type = count(array_count_values($arr_hand));
	$type = 0;

	if(str_contains($hand, "J"))
	{
		$char = array_search(max(array_count_values($arr_hand)), array_count_values($arr_hand));
	
		if($char == "J")
		{
			$hand = str_replace("J", "A", $hand);
		} else {
			$hand = str_replace("J", $char, $hand);
		}    

		return type_hand($hand);
	}

	// Five of a kind
	if($count_type == 1)
	{
		$type = 7;
	}

	// Four of a kind
	if($count_type == 2 && max(array_count_values($arr_hand))==4)
	{
		$type = 6;
	}

	// Full house
	if($count_type == 2 && max(array_count_values($arr_hand))==3)
	{
		$type = 5;
	}

	// Three of a kind
	if($count_type == 3 && max(array_count_values($arr_hand))==3)
	{
		$type = 4;
	}

	// Two pair
	if($count_type == 3 && max(array_count_values($arr_hand))==2)
	{
		$type = 3;
	}

	// One pair
	if($count_type == 4 && max(array_count_values($arr_hand))==2)
	{
		$type = 2;
	}

	// High card
	if($count_type == 5)
	{
		$type = 1;
	}

	return $type;
}

foreach ($hands as $key => $hand) {
	$push = true;

	if(count($ranked_hand) == 0)
	{
		array_push($ranked_hand, $hand);
	} else {
		foreach ($ranked_hand as $key => $rank) {
			$type_1 = type_hand($rank);
			$type_2 = type_hand($hand);

			//var_dump([$type_1,$type_2]);

			if($type_2 < $type_1)
			{
				array_splice($ranked_hand, $key, 0, $hand);
				$push = false;
				break;
			} else if ($type_2 == $type_1)
			{
				for ($i=0; $i < 5; $i++) { 
					$card_values_1 = array_search($rank[$i], $card_values);
					$card_values_2 = array_search($hand[$i], $card_values);

					if($card_values_2 < $card_values_1)
					{
						array_splice($ranked_hand, $key, 0, $hand);
						$push = false;
						break 2;
					} else if ($card_values_2 > $card_values_1)
					{
						break;
					}
				}
			}
		}
		if($push) array_push($ranked_hand, $hand);
	}
}

$total = 0;
foreach ($ranked_hand as $key => $value) {
	$total += (int)array_search($value, $hands)*($key+1);
}

var_dump($ranked_hand);

var_dump($total);