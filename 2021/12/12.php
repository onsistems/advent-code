<?php
$mcstart = microtime(true);
echo "<pre>\n";
$input = trim(str_replace("\r","",file_get_contents("input.txt")));

$paths = [];
$lines = explode("\n",$input);
foreach($lines as $line) {
    $bits = explode("-",$line);
    $paths[$bits[0]][] = $bits[1];
    $paths[$bits[1]][] = $bits[0];
}

$cave = "start";
$history = [];
$count = track($paths, $cave, $history, 0);

function track($paths, $cave, $history, $doubled) {
    $count = 0;
    $history[] = $cave;
    foreach($paths[$cave] as $path) {
        //looking back at start
        if($path == "start") {
            //do nothing
        }
        //small cave, not already visited
        else if(strtolower($path) === $path && in_array($path,$history)) {
            if($doubled == 0) {
                $count += track($paths, $path, $history, 1);
            }
            //else bad path, go no further
        }
        else if($path == "end") {
            //reached the end
            $count += 1;
            //echo implode(",",$history) ."\n";
        }
        else {
            $count += track($paths, $path, $history, $doubled);
        }
    }
    return $count;
}

echo "\nCount: {$count}";

$mcdiff = microtime(true) - $mcstart;
echo "\n\nTime: {$mcdiff}";