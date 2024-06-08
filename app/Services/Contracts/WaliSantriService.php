<?php

namespace App\Services\Contracts;

use App\Models\WaliSantri;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

interface WaliSantriService {
    public function getWaliSantris(): JsonResponse;

    public function findWaliSantri(string $id): Collection|WaliSantri;

    public function createWaliSantri(array $data): bool;

    public function updateWaliSantri(string $id, array $data): bool;

    public function deleteWaliSantri(string $id): bool;
}