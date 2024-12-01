<?php

//memory_reset_peak_usage();
$start_time = microtime(true);

$M = file_get_contents("input.txt");
$M = explode("\n", trim($M));
$Mh = count($M);
$Mw = strlen($M[0]);

const N = 0, E = 1, S = 2, W = 3;
const MOVES = [[0, -1], [1, 0], [0, 1], [-1, 0]];
function move($x, $y, $d) { return  [$x + MOVES[$d][0], $y + MOVES[$d][1], $d]; }

function f($start)
{
    global $M, $Mh, $Mw;
    $V = [];
    $Q = [$start];

    while ($Q)
    {
        [$x, $y, $d] = array_shift($Q);

        if ($x < 0 || $x >= $Mw) continue;
        if ($y < 0 || $y >= $Mh) continue;

        $key = "{$x},{$y}";
        if (in_array($d, $V[$key] ?? [])) continue;
        $V[$key][] = $d;

        switch ($M[$y][$x])
        {
            case '/':
                $Q[] = move($x, $y, [E, N, W, S][$d]);
                break;
            case '\\':
                $Q[] = move($x, $y, [W, S, E, N][$d]);
                break;
            case '|':
                if ($d == E || $d == W)
                    foreach ([N, S] as $_d) $Q[] = move($x, $y, $_d);
                else
                    $Q[] = move($x, $y, $d);
                break;
            case '-':
                if ($d == N || $d == S)
                    foreach ([E, W] as $_d) $Q[] = move($x, $y, $_d);
                else
                    $Q[] = move($x, $y, $d);
                break;
            default:
                $Q[] = move($x, $y, $d);
        }
    }
    return count($V);
}

$part1 = $part2 = f([0, 0, E]);
for ($x = 0; $x < $Mw; $x++) $part2 = max($part2, f([$x, 0, S]), f([$x, $Mh-1, N]));
for ($y = 0; $y < $Mh; $y++) $part2 = max($part2, f([0, $y, E]), f([$Mw-1, $y, W]));

echo "part 1: {$part1}\n";
echo "part 2: {$part2}\n";

echo "Execution time: ".round(microtime(true) - $start_time, 4)." seconds\n";
echo "   Peak memory: ".round(memory_get_peak_usage()/pow(2, 20), 4), " MiB\n\n";
