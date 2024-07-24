<?php

namespace App\Services\Contracts;

use App\Models\Pengeluaran;
use Illuminate\Http\JsonResponse;

interface PengeluaranService {
    public function getPengeluarans(string $startDate = null, string $endDate = null): JsonResponse;
    public function createKeuanganKeluar(array $data): bool;
    public function getKeuanganKelarById(int $id): Pengeluaran;
    public function updateKeuanganKeluar(int $id, array $data): bool;
    public function deleteKeuanganKeluar(int $id): bool;
}