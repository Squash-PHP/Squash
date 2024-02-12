<?php
/*
This file is used manually to benchmark every sorting algorithm, primarily used for documentation.
*/

require __DIR__ . '/../vendor/autoload.php';

$squash = \Squash\Squash::create();

// Set test data
$small_array = [];
$medium_array = [];
$large_array = [];
$huge_array = [];

// Generate small array (1 thousand)
for ($i = 0; $i < 1000; $i++) {
    $small_array[] = rand(0,1000);
}
shuffle($small_array);

// Generate medium array (10 thousand)
for ($i = 0; $i < 100000; $i++) {
    $medium_array[] = rand(0,10000);
}
shuffle($medium_array);

// Generate large array (500 thousand)
for ($i = 0; $i < 100000; $i++) {
    $large_array[] = rand(0,100000);
}
shuffle($large_array);

// Generate huge array (1 million)
for ($i = 0; $i < 1000000; $i++) {
    $huge_array[] = rand(0,1000000);
}
shuffle($huge_array);

echo "Small Array: ";
echo "" . number_format(count($small_array)) . " elements" . PHP_EOL;

echo "Medium Array: ";
echo "" . number_format(count($medium_array)) . " elements" . PHP_EOL;

echo "Large Array: ";
echo "" . number_format(count($large_array)) . " elements" . PHP_EOL;

echo "Huge Array: ";
echo "" . number_format(count($huge_array)) . " elements" . PHP_EOL;

// Merge sort
echo 'Starting merge sort on small array' . PHP_EOL;
$startMergeSmall = microtime(true);
$squash->sort->merge($small_array);
$endMergeSmall = microtime(true);

echo 'Starting merge sort on medium array' . PHP_EOL;
$startMergeMedium = microtime(true);
$squash->sort->merge($medium_array);
$endMergeMedium = microtime(true);

echo 'Starting merge sort on large array' . PHP_EOL;
$startMergeLarge = microtime(true);
$squash->sort->merge($large_array);
$endMergeLarge = microtime(true);

echo 'Starting merge sort on huge array' . PHP_EOL;
$startMergeHuge = microtime(true);
$squash->sort->merge($huge_array);
$endMergeHuge = microtime(true);

echo 'Merge sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endMergeSmall-$startMergeSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endMergeMedium-$startMergeMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endMergeLarge-$startMergeLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endMergeHuge-$startMergeHuge));

// Quick sort
echo 'Starting quick sort on small array' . PHP_EOL;
$startQuickSmall = microtime(true);
$squash->sort->quick($small_array);
$endQuickSmall = microtime(true);

echo 'Starting quick sort on medium array' . PHP_EOL;
$startQuickMedium = microtime(true);
$squash->sort->quick($medium_array);
$endQuickMedium = microtime(true);

echo 'Starting quick sort on large array' . PHP_EOL;
$startQuickLarge = microtime(true);
$squash->sort->quick($large_array);
$endQuickLarge = microtime(true);

echo 'Starting quick sort on huge array' . PHP_EOL;
$startQuickHuge = microtime(true);
$squash->sort->quick($huge_array);
$endQuickHuge = microtime(true);

echo 'Quick sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endQuickSmall-$startQuickSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endQuickMedium-$startQuickMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endQuickLarge-$startQuickLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endQuickHuge-$startQuickHuge));

// Selection sort
echo 'Starting selection sort on small array' . PHP_EOL;
$startSelectionSmall = microtime(true);
$squash->sort->selection($small_array);
$endSelectionSmall = microtime(true);

echo 'Starting selection sort on medium array' . PHP_EOL;
$startSelectionMedium = microtime(true);
$squash->sort->selection($medium_array);
$endSelectionMedium = microtime(true);

echo 'Starting selection sort on large array' . PHP_EOL;
$startSelectionLarge = microtime(true);
$squash->sort->selection($large_array);
$endSelectionLarge = microtime(true);

echo 'Starting selection sort on huge array' . PHP_EOL;
$startSelectionHuge = microtime(true);
$squash->sort->selection($huge_array);
$endSelectionHuge = microtime(true);

echo 'Selection sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endSelectionSmall-$startSelectionSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endSelectionMedium-$startSelectionMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endSelectionLarge-$startSelectionLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endSelectionHuge-$startSelectionHuge));

// Heap sort
echo 'Starting heap sort on small array' . PHP_EOL;
$startHeapSmall = microtime(true);
$squash->sort->heap($small_array);
$endHeapSmall = microtime(true);

echo 'Starting heap sort on medium array' . PHP_EOL;
$startHeapMedium = microtime(true);
$squash->sort->heap($medium_array);
$endHeapMedium = microtime(true);

echo 'Starting heap sort on large array' . PHP_EOL;
$startHeapLarge = microtime(true);
$squash->sort->heap($large_array);
$endHeapLarge = microtime(true);

echo 'Starting heap sort on huge array' . PHP_EOL;
$startHeapHuge = microtime(true);
$squash->sort->heap($huge_array);
$endHeapHuge = microtime(true);

echo 'Heap sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endHeapSmall-$startHeapSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endHeapMedium-$startHeapMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endHeapLarge-$startHeapLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endHeapHuge-$startHeapHuge));

// Radix sort
echo 'Starting radix sort on small array' . PHP_EOL;
$startRadixSmall = microtime(true);
$squash->sort->radix($small_array);
$endRadixSmall = microtime(true);

echo 'Starting radix sort on medium array' . PHP_EOL;
$startRadixMedium = microtime(true);
$squash->sort->radix($medium_array);
$endRadixMedium = microtime(true);

echo 'Starting radix sort on large array' . PHP_EOL;
$startRadixLarge = microtime(true);
$squash->sort->radix($large_array);
$endRadixLarge = microtime(true);

echo 'Starting radix sort on huge array' . PHP_EOL;
$startRadixHuge = microtime(true);
$squash->sort->radix($huge_array);
$endRadixHuge = microtime(true);

echo 'Radix sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endRadixSmall-$startRadixSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endRadixMedium-$startRadixMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endRadixLarge-$startRadixLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endRadixHuge-$startRadixHuge));
/*
// Bubble sort
echo 'Starting bubble sort on small array' . PHP_EOL;
$startBubbleSmall = microtime(true);
$squash->sort->bubble($small_array);
$endBubbleSmall = microtime(true);

echo 'Starting bubble sort on medium array' . PHP_EOL;
$startBubbleMedium = microtime(true);
$squash->sort->bubble($medium_array);
$endBubbleMedium = microtime(true);

echo 'Starting bubble sort on large array' . PHP_EOL;
$startBubbleLarge = microtime(true);
$squash->sort->bubble($large_array);
$endBubbleLarge = microtime(true);

echo 'Starting bubble sort on huge array' . PHP_EOL;
$startBubbleHuge = microtime(true);
$squash->sort->bubble($huge_array);
$endBubbleHuge = microtime(true);

echo 'Bubble sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endBubbleSmall-$startBubbleSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endBubbleMedium-$startBubbleMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endBubbleLarge-$startBubbleLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endBubbleHuge-$startBubbleHuge));

// Insertion sort
echo 'Starting insertion sort on small array' . PHP_EOL;
$startInsertionSmall = microtime(true);
$squash->sort->insertion($small_array);
$endInsertionSmall = microtime(true);

echo 'Starting insertion sort on medium array' . PHP_EOL;
$startInsertionMedium = microtime(true);
$squash->sort->insertion($medium_array);
$endInsertionMedium = microtime(true);

echo 'Starting insertion sort on large array' . PHP_EOL;
$startInsertionLarge = microtime(true);
$squash->sort->insertion($large_array);
$endInsertionLarge = microtime(true);

echo 'Starting insertion sort on huge array' . PHP_EOL;
$startInsertionHuge = microtime(true);
$squash->sort->insertion($huge_array);
$endInsertionHuge = microtime(true);

echo 'Insertion sort: ' . PHP_EOL . ' Small: '.sprintf("%.10f", ($endInsertionSmall-$startInsertionSmall)).'' . PHP_EOL . ' Medium: '.sprintf("%.10f", ($endInsertionMedium-$startInsertionMedium)).'' . PHP_EOL . ' Large: '.sprintf("%.10f", ($endInsertionLarge-$startInsertionLarge)).'' . PHP_EOL . ' Huge: '.sprintf("%.10f", ($endInsertionHuge-$startInsertionHuge));
*/
// take all results and add them to a csv file with how large the array was
$csv = fopen('sorting_benchmark.csv', 'a');
fputcsv($csv, [
    count($small_array),
    //$endBubbleSmall-$startBubbleSmall,
    //$endInsertionSmall-$startInsertionSmall,
    $endMergeSmall-$startMergeSmall,
    $endQuickSmall-$startQuickSmall,
    $endSelectionSmall-$startSelectionSmall,
    $endHeapSmall-$startHeapSmall,
    $endRadixSmall-$startRadixSmall
]);
fputcsv($csv, [
    count($medium_array),
    //$endBubbleMedium-$startBubbleMedium,
    //$endInsertionMedium-$startInsertionMedium,
    $endMergeMedium-$startMergeMedium,
    $endQuickMedium-$startQuickMedium,
    $endSelectionMedium-$startSelectionMedium,
    $endHeapMedium-$startHeapMedium,
    $endRadixMedium-$startRadixMedium
]);
fputcsv($csv, [
    count($large_array),
    //$endBubbleLarge-$startBubbleLarge,
    //$endInsertionLarge-$startInsertionLarge,
    $endMergeLarge-$startMergeLarge,
    $endQuickLarge-$startQuickLarge,
    $endSelectionLarge-$startSelectionLarge,
    $endHeapLarge-$startHeapLarge,
    $endRadixLarge-$startRadixLarge
]);
fputcsv($csv, [
    count($huge_array),
    //$endBubbleHuge-$startBubbleHuge,
    //$endInsertionHuge-$startInsertionHuge,
    $endMergeHuge-$startMergeHuge,
    $endQuickHuge-$startQuickHuge,
    $endSelectionHuge-$startSelectionHuge,
    $endHeapHuge-$startHeapHuge,
    $endRadixHuge-$startRadixHuge
]);
fclose($csv);

echo 'Benchmark complete' . PHP_EOL;