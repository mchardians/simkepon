<?php

namespace App\Services\Implementations;

use Carbon\Carbon;
use App\Models\Iuran;
use Illuminate\Support\Number;
use App\Services\Contracts\IuranService;
use Yajra\DataTables\Facades\DataTables;

class IuranServiceImp implements IuranService {
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIurans(string $date = null): \Illuminate\Http\JsonResponse {
        if($date !== null) {
            $query = Iuran::query()->select(['santri.name', 'masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])
            ->join('santri', 'iuran.santri_id', '=', 'santri.id')
            ->whereMonth('date', Carbon::parse($date)->month)
            ->whereYear('date', Carbon::parse($date)->year);
        } else {
            $query = Iuran::query()->select(['santri.name', 'masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])
                    ->join('santri', 'iuran.santri_id', '=', 'santri.id')
                    ->whereMonth('date', date('m'))
                    ->whereYear('date', date('Y'));
        }

        if(auth()->user()->role->name === 'walisantri') {
            $query = Iuran::query()->select(['santri.name', 'masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])
                ->join('santri', 'iuran.santri_id', '=', 'santri.id')
                ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
                ->where('wali_santri.email', '=', auth()->user()->email);

            if($date !== null) {
                $query = $query->whereMonth('date', Carbon::parse($date)->month)
                    ->whereYear('date', Carbon::parse($date)->year)
                    ->where('wali_santri.email', '=', auth()->user()->email);
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('masak', function($data) {
                return Number::currency($data->masak, 'IDR');
            })
            ->editColumn('gas_minyak', function($data) {
                return Number::currency($data->gas_minyak, 'IDR');
            })
            ->editColumn('kas', function($data) {
                return Number::currency($data->kas, 'IDR');
            })
            ->editColumn('tabungan', function($data) {
                return Number::currency($data->tabungan, 'IDR');
            })
            ->editColumn('bisaroh', function($data) {
                return Number::currency($data->bisaroh, 'IDR');
            })
            ->editColumn('transport', function($data) {
                return Number::currency($data->transport, 'IDR');
            })
            ->editColumn('darurat', function($data) {
                return Number::currency($data->darurat, 'IDR');
            })
            ->addColumn('total', function($data) {
                return Number::currency(($data->masak + $data->gas_minyak + $data->kas + $data->tabungan + $data->bisaroh + $data->transport + $data->darurat), 'IDR');
            })
            ->make(true);
    }

    public function createIuran(array $data): bool {
        $query = Iuran::query()->select(['masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])
                ->where('santri_id', $data['santri_id'])
                ->whereMonth('date', Carbon::parse($data['date'])->month)
                ->whereYear('date', Carbon::parse($data['date'])->year);

        if($query->exists()) {
            $query = $query->first()->toArray();

            foreach ($data as $key => $value) {
                if(isset($query[$key])) {
                    $data[$key] = $data[$key] + $query[$key];
                }
            }
            
            return Iuran::query()->where('santri_id', $data['santri_id'])
            ->whereMonth('date', Carbon::parse($data['date'])->month)
            ->whereYear('date', Carbon::parse($data['date'])->year)
            ->update($data);
        }

        return Iuran::query()->insert($data);
    }
}