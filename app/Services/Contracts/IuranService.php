<?php

namespace App\Services\Contracts;

use Illuminate\Http\JsonResponse;

interface IuranService {
    public function getIurans(string $date = null): JsonResponse;
    public function createIuran(array $data): bool;
}