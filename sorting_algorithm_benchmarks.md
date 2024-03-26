# Benchmarks of sorting algorithms

## POC benchmark
Observations: 100 million elements is too many
Benchmarked with 32GB of RAM on a Ryzen 5 4600g CPU.
```
Small Array: 1,000 elements
Medium Array: 10,000 elements
Large Array: 100,000 elements
Huge Array: 100,000,000 elements
Merge sort: 
 Small: 0.0015358925
 Medium: 0.0220851898
 Large: 0.2662229538
 Huge: 405.3693931103
 ```

## Actual benchmarks
Benchmarked on Ubuntu 20.04.6 LTS x86_64 with 24GB of RAM on an Intel Xeon E3-12xx v2 (Ivy Bridge) (6) @ 2.793GHz

Test data:

(Random numbers between 0 and total elenments in the array.)
```
Small Array: 1,000 elements
Medium Array: 10,000 elements
Large Array: 100,000 elements
Huge Array: 1,000,000 elements
```

| Elements | Bubble      | Insertion   | Merge       | Quick       | Selection   | Heap        | Radix       |
|----------|-------------|-------------|-------------|-------------|-------------|-------------|-------------|
| 1,000     | 0.03426599503 | 0.01111197472 | 0.002865076065 | 0.0008888244629 | 0.01087403297 | 0.003700971603 | 2.738460064 |
| 10,000   | 333.5179441 | 126.4449658 | 0.3013739586 | 0.1914930344 | 120.1440361 | 0.4430589676 | 279.235775 |
| 100,000   | 333.136224 | 126.7856209 | 0.2915258408 | 0.1936581135 | 120.4276249 | 0.4564139843 | 277.654609 |
| 1,000,000  | 32220.78509 | 12995.50291 | 3.491767883 | 2.618948221 | 13561.82273 | 5.604738951 | 2713.642992 |

![Benchmark Graph](/sorting_benchmark.png)

Observations:
- Bubble sort is the slowest algorithm
- Quick sort is the fastest algorithm
- Merge sort is the second fastest algorithm
- All agorithms are very similar in performance for small arrays
- Quick sort is the most consistent, staying at 0.2s for 10k and 100k elements
