<?php

//memory_reset_peak_usage();
$start_time = microtime(true);

$G = file_get_contents("input.txt");
$G = explode("\n", trim($G));
$G = array_map(fn($r)=>str_split($r), $G);

function rotate($a)
{
    $a = array_map(null, ...$a);
    array_walk($a, fn(&$r)=>$r = array_reverse($r));
    return $a;
}

function tilt($a)
{
    $a = rotate($a);
    array_walk($a, function (&$r)
    {
        $s = implode($r);
        while (str_contains($s, "O."))
            $s = preg_replace("/(O+)([.]+)/", "$2$1", $s);
        $r = str_split($s);
    });
    return $a;
}

function load($a)
{
    $result = 0;
    foreach ($a as $r) foreach ($r as $i => $c)
        if ($c == "O") $result += $i + 1;
    return $result;
}

$part1 = load(tilt($G));

$cycle = 0;
$goal = 1e9;

$V = [];
while ($cycle++ < $goal)
{
    foreach (range(0, 3) as $i) $G = tilt($G);
    $key = sha1(json_encode($G));
    if (isset($V[$key]))
    {
//        echo "cycle detected: $cycle -> ";
        $cycle_len = $cycle - $V[$key];
        $coverage = floor(($goal - $cycle) / $cycle_len);
        $cycle += $cycle_len * $coverage;
//        echo $cycle, "\n";
    }
    $V[$key] = $cycle;
}
$part2 = load(rotate($G));

echo "part 1: {$part1}\n";
echo "part 2: {$part2}\n";

echo "Execution time: ".round(microtime(true) - $start_time, 4)." seconds\n";
echo "   Peak memory: ".round(memory_get_peak_usage()/pow(2, 20), 4), " MiB\n\n";
