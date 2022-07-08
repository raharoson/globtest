<?php

declare(strict_types=1);

namespace App\Traits;

trait ArrayFunctions
{   
    /**
     * Flatten an array of arrays. The `$levels` parameter specifies how deep you want to
     * recurse in the array. If `$levels` is -1, the function will recurse infinitely.
     *
     * @param array $array
     * @param int   $levels
     *
     * @return array
     */
    public function array_flatten(array $array, $levels = -1)
    {
        if ($levels === 0) {
            return $array;
        }
    
        $flattened = [];
    
        if ($levels !== -1) {
            --$levels;
        }
    
        foreach ($array as $element) {
            $flattened[] = is_array($element) ? $this->array_flatten($element, $levels) : [$element];
        }
    
        return array_merge([], ...$flattened);
    }   

    /**
     * Determine if two associative arrays are similar
     *
     * Both arrays must have the same indexes with identical values
     * without respect to key ordering 
     * 
     * @param array $a
     * @param array $b
     * @return bool
     */
    public function arrays_are_similar(array $a, array $b) {
        var_dump(array_merge());

        // if the indexes don't match, return immediately
        if (count(array_diff_assoc($a, $b))) {
            return false;
        }
        // we know that the indexes, but maybe not values, match.
        // compare the values between the two arrays
        foreach($a as $k => $v) {
            if ($v !== $b[$k]) {
            return false;
            }
        }
        // we have identical indexes, and no unequal values
        return true;
    }
}