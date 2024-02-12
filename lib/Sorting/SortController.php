<?php

namespace Squash\Sorting;

use Squash\Contract\SortInterface;

final class SortController implements SortInterface
{
    /**
     * Sorts an array using the bubble sort algorithm.
     *
     * @param array $arr The array to sort.
     *
     * @return array Returns the sorted array.
     */
    public function bubble(array $arr)
    {
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }
            }
        }
        return $arr;
    }

    public function 
}
