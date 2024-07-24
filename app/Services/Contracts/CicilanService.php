<?php

namespace App\Services\Contracts;

use App\Models\Cicilan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

interface CicilanService {
    public function getCicilans(): JsonResponse;
    public function createCicilan(array $data): bool;
    public function checkSantriCicilan(int $id): Cicilan|Collection;
    public function getCicilan(string $id);
}