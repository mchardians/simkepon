<?php

namespace App\Services\Contracts;

use App\Models\DetailPemasukan;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

interface PemasukanService {
    public function getPemasukans(string $status = null, string $startDate = null, string $endDate = null): JsonResponse;
    public function createPemasukan(array $data): int;
    public function createDetailPemasukan(array $data, int $id): bool;
    public function getDetailPemasukans(int $id): DetailPemasukan|Collection;
    public function deletePemasukan(int $id): bool;
    public function getRiwayatPemasukans(): JsonResponse;
}