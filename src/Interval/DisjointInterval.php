<?php

declare(strict_types=1);

namespace App\Interval;

use App\Traits\ArrayFunctions;

class DisjointInterval
{
    use ArrayFunctions;

    public function foo(array $arrays): array
    {
        $sorted = $this->sortByX($arrays);
        $flatten = $this->array_flatten($sorted);
        
        $result = [min($flatten), max($flatten)];
        $comp = $flatten[1];
        for ($i = 1; $i < count($flatten) - 2; $i += 2) {
            if ($comp >= $flatten[$i + 1] && $comp <= $flatten[$i + 2]) {
                $comp = $flatten[$i + 2]; 
                continue;
            }

            if ($comp < $flatten[$i + 1]) {
                array_push($result, ...[$comp, $flatten[$i + 1], $flatten[$i + 2]]);
                $comp = $flatten[$i + 2]; 
            }
        }
        
        usort($result, fn($a, $b) => $a <=> $b);

        return $this->deflatten(
            array_unique($result)
        );
    }

    /**
     * Tri par ordre croissante par rapport à la somme par item
     */
    private function sortByX(array $arrays): array
    {
        usort($arrays, fn($a, $b) => $a[0] <=> $b[0]);
        return $arrays;
    }

    private function deflatten(array $flatenedArrays): array
    {
        for ($i = 0; $i < count($flatenedArrays) - 1; $i += 2) {
            $result[] = [$flatenedArrays[$i], $flatenedArrays[$i + 1]];
        }

        return $result ?? [];

    }


}