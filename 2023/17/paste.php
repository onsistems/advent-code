<?php

memory_reset_peak_usage();
$start_time = microtime(true);

$G = file_get_contents("input.txt");
$G = explode("\n", trim($G));
$Gh = count($G);
$Gw = strlen($G[0]);

const MOVES = [[0, -1], [1, 0], [0, 1], [-1, 0]];

function f($start, $end, $min_dist = 1, $max_dist = 3)
{
    global $G, $Gh, $Gw;

    $V = [];
    $H = new SplMinHeap();

    $H->insert([0, [$start[0], $start[1], -1, 0]]);

    while (!$H->isEmpty())
    {
        [$dist, [$x, $y, $dir, $dc]] = $H->extract();

        $key = "$x,$y,$dir,$dc";
        if (isset($V[$key])) continue;
        $V[$key] = $dist;

        if ([$x, $y] == $end) return $dist;

        foreach (MOVES as $ndir => $MOVE)
        {
            $nx = $x + $MOVE[0];
            $ny = $y + $MOVE[1];
            if ($nx < 0 || $nx >= $Gw || $ny < 0 || $ny >= $Gh || ($ndir + 2) % 4 == $dir) continue;

            $ndc = ($ndir == $dir ? $dc + 1 : 1);
            if ($ndc > $max_dist || ($dist && $ndir != $dir && $dc < $min_dist)) continue;

            $ndist = $dist + (int)($G[$ny][$nx]);
            $H->insert([$ndist, [$nx, $ny, $ndir, $ndc]]);
        }
    }
    assert(false);
}

$part1 = f([0, 0], [$Gw-1, $Gh-1]);
$part2 = f([0, 0], [$Gw-1, $Gh-1], 4, 10);

echo "part 1: {$part1}\n";
echo "part 2: {$part2}\n";

echo "Execution time: ".round(microtime(true) - $start_time, 4)." seconds\n";
echo "   Peak memory: ".round(memory_get_peak_usage()/pow(2, 20), 4), " MiB\n\n";
