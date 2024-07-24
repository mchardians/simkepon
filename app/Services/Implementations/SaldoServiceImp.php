<?php

namespace App\Services\Implementations;

use App\Models\Saldo;
use App\Services\Contracts\SaldoService;

class SaldoServiceImp implements SaldoService {
    public function increaseBalance($iuran, int $amount) {
        return Saldo::query()->where('iuran', $iuran)->increment('amount', $amount);
    }

    public function decreaseBalance($iuran, int $amount) {
        return Saldo::query()->where('iuran', $iuran)->decrement('amount', $amount);
    }
}