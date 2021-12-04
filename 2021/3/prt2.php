<?php
declare(strict_types=1);

$data = file_get_contents('input.txt');
$input = preg_split('/\n+/', $data, -1, PREG_SPLIT_NO_EMPTY);
while($line = fgets(STDIN))
{
    $line = trim($line);
    $width = strlen($line);
    $input[] = bindec($line);
}

$oxygenRating = calculateOxygenGeneratorRating($input, $width);
$co2Rating = calculateCo2ScrubberRating($input, $width);
$lifeSupportRating = $oxygenRating * $co2Rating;

echo "$oxygenRating * $co2Rating = $lifeSupportRating\n";

function calculateOxygenGeneratorRating(array $input, int $width): int
{
    $rating = 0;
    for($column = $width - 1; $column >= 0; $column--)
    {
        $mostCommonBit = findCommonBit(getColumn($input, $column)) ?? 1;
        $rating <<= 1;
        $rating |= $mostCommonBit;
        $input = array_filter($input, fn($row) => nthBit($row, $column) === $mostCommonBit);
        if(sizeof($input) === 1)
        {
            $rating = end($input);
            break;
        }
    }
    return $rating;
}

function calculateCo2ScrubberRating(array $input, int $width): int
{
    $rating = 0;
    for($column = $width - 1; $column >= 0; $column--)
    {
        $mostCommonBit = findCommonBit(getColumn($input, $column));
        $rating <<= 1;
        $leastCommonBit = 0;
        if($mostCommonBit === null)
        {
            $leastCommonBit = 0;
        }
        else
        {
            $leastCommonBit = $mostCommonBit === 0 ? 1 : 0;
        }
        $rating |= $leastCommonBit;
        $input = array_filter($input, fn($row) => nthBit($row, $column) === $leastCommonBit);
        if(sizeof($input) === 1)
        {
            $rating = end($input);
            break;
        }
    }
    return $rating;
}

function getColumn(array $matrix, int $column): \Generator
{
    foreach($matrix as $row)
    {
        yield nthBit($row, $column);
    }
}

function nthBit(int $value, int $bit)
{
    return ($value & (1 << $bit)) === 0 ? 0 : 1;
}

function findCommonBit(\Generator $column): ?int
{
    $zeroes = 0;
    $ones = 0;

    foreach($column as $bit)
    {
        if($bit === 0)
        {
            $zeroes++;
        }
        else
        {
            $ones++;
        }
    }
    if($zeroes === $ones)
    {
        return null;
    }
    return $zeroes > $ones ? 0 : 1;
}