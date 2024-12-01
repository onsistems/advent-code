
<?PHP

$data = "2344671212
6611742681
5575575573
3167848536
1353827311
4416463266
2624761615
1786561263
3622643215
4143284653";
if ($data === false)
	die("Error: Invalid file.\n");
$data = prep($data);

// PART 1
echo "Part 1: There are a total of \e[32m", part_one($data), "\e[0m flashes, after 100 steps.\n";

// PART 2
echo "Part 1: The first is \e[32m", part_two($data), "\e[0m after all octopuses flash at once.\n";


function	part_one(array $grid, int $steps = 100): int
{
	$flashes = 0;

	while ($steps--)
	{
		$new_grid = $grid;

		foreach ($grid as $y => $row)
			foreach ($row as $x => $octopus)
				$flashes += increase($grid, $new_grid, $y, $x);
		$grid = $new_grid;
	}
	return $flashes;
}

function	increase(array $grid, array &$newgrid, int $y, int $x): int
{
	$flashes = 0;

	if (!($newgrid[$y][$x] === 0 && $grid[$y][$x] !== 0) &&
		$newgrid[$y][$x]++ >= 9)
	{
		$flashes++;
		$newgrid[$y][$x] = 0;

		foreach ([
			[$y - 1, $x - 1], [$y - 1 , $x], [$y - 1, $x + 1],
			[$y, $x - 1], /* current octopus */ [$y, $x + 1],
			[$y + 1, $x - 1], [$y + 1, $x], [$y + 1, $x + 1]
		] as $c
		) {
			if (isset($newgrid[ $c[0] ][ $c[1] ]))
				$flashes += increase($grid, $newgrid, $c[0], $c[1]);
		}
	}
	return $flashes;
}

function	part_two(array $grid): int
{
	$step = 0;
	$total_oct = array_sum(array_map('count', $grid));

	while (true)
	{
		$flashes = 0;
		$new_grid = $grid;

		foreach ($grid as $y => $row)
			foreach ($row as $x => $octopus)
				$flashes += increase($grid, $new_grid, $y, $x);
		$grid = $new_grid;
		$step++;

		if ($flashes === $total_oct)
			break ;
	}
	return $step;
}

function	prep(string $data): array
{
	return array_map("str_split", array_filter(explode("\n", $data)));
}

