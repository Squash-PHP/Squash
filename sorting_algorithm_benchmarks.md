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