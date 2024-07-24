<?php

namespace Database\Seeders;

use App\Models\Saldo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $saldos = [
            [
                'iuran' => 'masak',
                'amount' => 0
            ],
            [
                'iuran' => 'gas_minyak',
                'amount' => 0
            ],
            [
                'iuran' => 'kas',
                'amount' => 0
            ],
            [
                'iuran' => 'tabungan',
                'amount' => 0
            ],
            [
                'iuran' => 'bisaroh',
                'amount' => 0
            ],
            [
                'iuran' => 'transport',
                'amount' => 0
            ],
            [
                'iuran' => 'darurat',
                'amount' => 0
            ],
        ];

        Saldo::query()->insert($saldos);
    }
}
