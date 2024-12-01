<?php

memory_reset_peak_usage();
$start_time = microtime(true);

$maps = file_get_contents("input.txt");
$maps = explode("\n\n", trim($maps));

$part1 = $part2 = 0;

foreach ($maps as $m => $map)
{
    $map = explode("\n", $map);
    [$w, $h] = [strlen($map[0]), count($map)];
    for ($y = 0; $y < $h-1; $y++)
    {
        $diff = 0;
        for ($i = 0; $y - $i >= 0 && $y + 1 + $i < $h; $i++)
            for ($x = 0; $x < $w; $x++)
                if ($map[$y - $i][$x] != $map[$y + 1 + $i][$x])
                    if (++$diff > 1) break 2;
        if ($diff == 0) $part1 += 100 * ($y + 1);
        if ($diff == 1) $part2 += 100 * ($y + 1);
    }
    for ($x = 0; $x < $w-1; $x++)
    {
        $diff = 0;
        for ($i = 0; $x - $i >= 0 && $x + 1 + $i < $w; $i++)
            for ($y = 0; $y < $h; $y++)
                if ($map[$y][$x - $i] != $map[$y][$x + 1 + $i])
                    if (++$diff > 1) break 2;
        if ($diff == 0) $part1 += $x + 1;
        if ($diff == 1) $part2 += $x + 1;
    }
}

echo "part 1: {$part1}\n";
echo "part 2: {$part2}\n";

echo "Execution time: ".round(microtime(true) - $start_time, 4)." seconds\n";
echo "   Peak memory: ".round(memory_get_peak_usage()/pow(2, 20), 4), " MiB\n\n";
