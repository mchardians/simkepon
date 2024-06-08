<?php

namespace App\Services\Contracts;

use App\Models\Santri;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

interface SantriService
{
    public function getSantris(string $gender = null): JsonResponse;
    public function getWaliSantris(): Collection;
    public function findSantri(string $id): Collection|Santri;
    public function createSantri(array $data): bool;
    public function updateSantri(string $id, array $data): bool;
    public function deleteSantri(string $id): bool;
    public function getDetailsSantri(string $id): Collection|Santri;
}