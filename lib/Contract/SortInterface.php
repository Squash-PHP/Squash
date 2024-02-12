<?php


namespace Squash\Contract;

interface SortInterface
{
    public function bubble(array $arr): array;
    public function insertion(array $arr): array;
    public function merge(array $arr): array;
    public function quick(array $arr): array;
    public function selection(array $arr): array;
    public function heap(array $arr): array;
    public function radix(array $arr): array;
}