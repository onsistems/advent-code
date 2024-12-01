<?php

// Advent of Code 2022 - Day 11: Monkey in the Middle
ini_set('memory_limit',-1);

$monkeys = [
  (object) [
    'items' => [79,98],
    'operation' => fn($e) => $e*19 ,
    'test' => fn($t) => $t%23==0?2:3,
    'inspected_items' => 0
  ],
  (object) [
    'items' => [54, 65, 75, 74],
    'operation' => fn($e) => $e+6 ,
    'test' => fn($t) => $t%19==0?2:0,
    'inspected_items' => 0
  ],
  (object) [
    'items' => [79, 60, 97],
    'operation' => fn($e) => $e*$e ,
    'test' => fn($t) => $t%13==0?1:3,
    'inspected_items' => 0
  ],
  (object) [
    'items' => [74],
    'operation' => fn($e) => $e+3 ,
    'test' => fn($t) => $t%17==0?0:1,
    'inspected_items' => 0
  ],
];


function monkey_business(int $rounds = 20)
{
	global $monkeys, $lcm;
	for ($i=0; $i < $rounds; $i++) { 
		foreach ($monkeys as $key1 => $monkey) {
			$lcm = 1;
			var_dump($monkey->items);
			foreach ($monkey->items as $item) {
				$lcm = gmp_lcm($lcm,$item);
			}
			var_dump($lcm);
			foreach ($monkey->items as $key2 => $item) {
				unset($monkey->items[$key2]);
				$monkey->inspected_items++;
				$item = ($monkey->operation)($item);

				
				$item = intval($item%$lcm);
				$next_monkey = ($monkey->test)($item);
				array_push($monkeys[$next_monkey]->items, $item);
			}
		}
	}
	return $monkeys;
}



$arr_inspected = array_map(fn($e)=>$e->inspected_items, monkey_business(20));
var_dump($arr_inspected);
rsort($arr_inspected);
echo ($arr_inspected[0]*$arr_inspected[1])."\n";

