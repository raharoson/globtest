<?php

require __DIR__.'/vendor/autoload.php';

use App\Interval\DisjointInterval;

$a = [[0, 3], [6, 10]];
$b = [[0, 5], [3, 10]];	
$c = [[0, 5], [2, 4]];	
$d = [[7, 8], [3, 6], [2, 4]];	
$e = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];	

$disjointInterval = new DisjointInterval();

dump(
    $disjointInterval->foo($a),
    $disjointInterval->foo($b),
    $disjointInterval->foo($c),
    $disjointInterval->foo($d),
    $disjointInterval->foo($e), 
);