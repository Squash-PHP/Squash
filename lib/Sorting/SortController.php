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
    public function bubble(array $arr): array
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

    /**
     * Sorts an array using the insertion sort algorithm.
     *
     * @param array $arr The array to sort.
     *
     * @return array Returns the sorted array.
     */
    public function insertion(array $arr): array
    {
        $n = count($arr);
        for ($i = 1; $i < $n; $i++) {
            $key = $arr[$i];
            $j = $i - 1;
            while ($j >= 0 && $arr[$j] > $key) {
                $arr[$j + 1] = $arr[$j];
                $j = $j - 1;
            }
            $arr[$j + 1] = $key;
        }
        return $arr;
    }

    /**
     * Sorts an array using the merge sort algorithm.
     *
     * @param array $arr The array to sort.
     *
     * @return array Returns the sorted array.
     */
    function merge(array $arr): array
    {
        $n = count($arr);
        if ($n <= 1) {
            return $arr;
        }

        $mid = (int) ($n / 2);
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);

        $left = $this->merge($left);
        $right = $this->merge($right);

        $result = [];
        $i = $j = 0;
        while ($i < count($left) && $j < count($right)) {
            if ($left[$i] < $right[$j]) {
                $result[] = $left[$i];
                $i++;
            } else {
                $result[] = $right[$j];
                $j++;
            }
        }

        while ($i < count($left)) {
            $result[] = $left[$i];
            $i++;
        }

        while ($j < count($right)) {
            $result[] = $right[$j];
            $j++;
        }

        return $result;
    }
    
    /**
     * Sorts an array using the selection sort algorithm.
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function selection(array $arr): array {
        $n = count($arr);
        
        for ($i = 0; $i < $n - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($arr[$j] < $arr[$minIndex]) {
                    $minIndex = $j;
                }
            }
            if ($minIndex != $i) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$minIndex];
                $arr[$minIndex] = $temp;
            }
        }
        
        return $arr;
    }

    /**
     * Sorts an array using the heap sort algorithm.
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function heap(array $arr): array {
        $n = count($arr);

        // Build heap (rearrange array)
        for ($i = (int)($n / 2) - 1; $i >= 0; $i--) {
            $this->heapify($arr, $n, $i);
        }

        // One by one extract an element from heap
        for ($i = $n - 1; $i > 0; $i--) {
            // Move current root to end
            $temp = $arr[0];
            $arr[0] = $arr[$i];
            $arr[$i] = $temp;

            // call max heapify on the reduced heap
            $this->heapify($arr, $i, 0);
        }

        return $arr;
    }

    /**
     * Helper function to heapify a subtree rooted with node $i.
     *
     * @param array $arr The array to be heapified.
     * @param int $n Size of heap.
     * @param int $i Index of the root of the subtree to be heapified.
     */
    private function heapify(&$arr, $n, $i) {
        $largest = $i;  // Initialize largest as root
        $left = 2 * $i + 1;  // left = 2*i + 1
        $right = 2 * $i + 2;  // right = 2*i + 2

        // If left child is larger than root
        if ($left < $n && $arr[$left] > $arr[$largest])
            $largest = $left;

        // If right child is larger than largest so far
        if ($right < $n && $arr[$right] > $arr[$largest])
            $largest = $right;

        // If largest is not root
        if ($largest != $i) {
            $swap = $arr[$i];
            $arr[$i] = $arr[$largest];
            $arr[$largest] = $swap;

            // Recursively heapify the affected sub-tree
            $this->heapify($arr, $n, $largest);
        }
    }

    /**
     * Sorts an array using the radix sort algorithm.
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function radix(array $arr): array {
        $max = max($arr);
        $exp = 1;
        $n = count($arr);

        while ($max / $exp > 0) {
            $count = array_fill(0, 10, 0);
            $output = array_fill(0, $n, 0);

            for ($i = 0; $i < $n; $i++) {
                $count[($arr[$i] / $exp) % 10]++;
            }

            for ($i = 1; $i < 10; $i++) {
                $count[$i] += $count[$i - 1];
            }

            for ($i = $n - 1; $i >= 0; $i--) {
                $output[$count[($arr[$i] / $exp) % 10] - 1] = $arr[$i];
                $count[($arr[$i] / $exp) % 10]--;
            }

            for ($i = 0; $i < $n; $i++) {
                $arr[$i] = $output[$i];
            }

            $exp *= 10;
        }

        return $arr;
    }

    /**
     * Sorts an array using the quick sort algorithm.
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function quick(array $arr): array {
        $n = count($arr);
        if ($n <= 1) {
            return $arr;
        }

        $pivot = $arr[0];
        $left = $right = [];

        for ($i = 1; $i < $n; $i++) {
            if ($arr[$i] < $pivot) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }

        return array_merge($this->quick($left), [$pivot], $this->quick($right));
    }
}
