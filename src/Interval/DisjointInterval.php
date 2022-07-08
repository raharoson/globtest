<?php

declare(strict_types=1);

namespace App\Interval;

use App\Traits\ArrayFunctions;

class DisjointInterval
{
    use ArrayFunctions;

    /**
     * Print ensemble d'intervalle disjoint 
     */
    public function foo(array $arrays): array
    {
        $sortedArrays = $this->sortBySum($arrays);

        $tmpItem = $sortedArrays[0];
        $results = [$tmpItem];
        for ($index = 1; $index < count($sortedArrays); $index++) {
            $merge = $this->merge($tmpItem, $sortedArrays[$index]);
            $tmpItem = $merge[array_key_last($merge)];
            array_pop($results);
            array_push($results, ...$merge);
        }
        return $results;
    }

    /**
     * Tri par ordre croissante par rapport à la somme par item
     */
    private function sortBySum(array $arrays): array
    {
        usort($arrays, fn($a, $b) => array_sum($a) <=> array_sum($b));
        return $arrays;
    }

    /** 
     * Merge entre deux array
     */
    private function merge(array $a, array $b): array
    {
        if ($a[1] < $b[0]) {
            return [$a, $b];
        }
        $flatten = $this->array_flatten([$a, $b]);

        return [[min($flatten), max($flatten)]];
    }
}