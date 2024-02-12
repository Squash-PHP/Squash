<?php


namespace Squash\Contract;

interface SortInterface
{
    public function bubble(array $arr): array;
    public function insertion(array $arr): array;
    public function merge(array $arr): array;
}