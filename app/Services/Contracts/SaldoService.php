<?php

namespace App\Services\Contracts;

interface SaldoService {
    public function increaseBalance(string $iuran, int $amount);
    public function decreaseBalance(string $iuran, int $amount);
}