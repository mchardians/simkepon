<?php

namespace App\Services\Implementations;

use Carbon\Carbon;
use App\Models\Iuran;
use App\Models\Saldo;
use App\Models\Pemasukan;
use Illuminate\Support\Number;
use App\Models\DetailPemasukan;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Contracts\PemasukanService;

class PemasukanServiceImp implements PemasukanService {
    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPemasukans(string $status = null, string $startDate = null, string $endDate = null): JsonResponse {
        $query = Pemasukan::query()->select(
            [
                'pemasukan.id', 'santri.name', 'payment_code',
                'total_payment', 'payment_date', 'status'
            ])
            ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
            ->whereMonth('payment_date', '=', date('m'))
            ->whereYear('payment_date', '=', date('Y'))
            ->orderBy('payment_date', 'desc');

        if($status !== null) {
            $query = $query->where('status', '=', $status);
        }

        if($startDate !== null && $endDate !== null) {
            $query = Pemasukan::query()->select(
                [
                    'pemasukan.id', 'santri.name', 'payment_code',
                    'total_payment', 'payment_date', 'status'
                ])
                ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
                ->whereBetween('payment_date', [
                    Carbon::parse($startDate)->startOfDay()->toDateTimeString(),
                    Carbon::parse($endDate)->endOfDay()->toDateTimeString()
                ])
                ->orderBy('payment_date', 'desc');
        }

        if($status !== null && $startDate !== null && $endDate !== null) {
            $query = $query->where('status', '=', $status)
                    ->whereBetween('payment_date', [
                        Carbon::parse($startDate)->startOfDay()->toDateTimeString(),
                        Carbon::parse($endDate)->endOfDay()->toDateTimeString()
                    ]);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('payment_code', function($data) {
                if(auth()->user()->role->name == 'kepalapondok') {
                    return $data->payment_code;
                }

                $url = route('bendahara.keuangan-masuk.invoice', $data->id);
                return "<a href='{$url}'>{$data->payment_code}</a>";
            })
            ->editColumn('total_payment', function($data) {
                return Number::currency($data->total_payment, 'IDR');
            })
            ->editColumn('status', function($data) {
                return $data->status == 'lunas' ? "<div class='badge badge-success'>Lunas</div>" : "<div class='badge badge-danger'>Belum Lunas</div>";
            })
            ->addColumn('action', function ($data) {
                if(auth()->user()->role->name == 'kepalapondok') {
                    return '<button class="btn btn-action btn-danger mr-1 btn-delete" id="'.$data->id.'">
                        <i class="fas fa-trash"></i>
                    </button>';
                }

                return (
                    '<button class="btn btn-action btn-info mr-1 btn-detail" id="'.$data->id.'" data-toggle="modal" data-target="#infoModal">
                        <i class="fas fa-info-circle"></i>
                    </button>'.
                    '<a class="btn btn-action btn-dark mr-1 btn-invoice" id="'.$data->id.'" href="'.route('bendahara.keuangan-masuk.invoice', $data->id).'">
                        <i class="fas fa-file-invoice"></i>
                    </a>'
                );
            })
            ->rawColumns(['payment_code', 'status', 'action'])
            ->make(true);
    }

    public function createPemasukan(array $data): int {
        $pemasukan = Pemasukan::query()->where('santri_id', $data['santri_id'])
            ->whereMonth('payment_date', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->where('status', 'belum_lunas')
            ->first();

        if($pemasukan !== null) {
            $totalPayment = ($pemasukan->total_payment + $data['total_payment']);
            if($totalPayment === 200000) {
                $pemasukan->update([
                    'payment_date' => $data['payment_date'],
                    'total_payment' => $totalPayment,
                    'status' => 'lunas'
                ]);

                return $pemasukan->id;
            }else {
                $pemasukan->update([
                    'payment_date' => $data['payment_date'],
                    'total_payment' => $totalPayment,
                    'status' => 'belum_lunas',
                ]);

                return $pemasukan->id;
            }
        }

        return Pemasukan::query()->insertGetId($data);
    }

    public function createDetailPemasukan(array $data, int $id): bool {
        $pemasukan = Pemasukan::query()->where('id', $id)
                    ->first();

        if($pemasukan->exists()) {

            foreach ($data as $key => $value) {
                $data[$key]['pemasukan_id'] = $pemasukan->id;
            }

            return DetailPemasukan::query()->where('pemasukan_id', $pemasukan->id)
                ->insert($data);
        }

        foreach ($data as $key => $value) {
            $data[$key]['pemasukan_id'] = $id;
        }

        return DetailPemasukan::query()->insert($data);
    }

    public function getDetailPemasukans(int $id): DetailPemasukan|\Illuminate\Database\Eloquent\Collection {
        return DetailPemasukan::query()->select(['month', 'year', 'amount', 'iuran'])
        ->join('pemasukan', 'detail_pemasukan.pemasukan_id', '=', 'pemasukan.id')
        ->where('pemasukan_id', $id)->get();
    }

    public function deletePemasukan(int $id): bool {
        $pemasukan = Pemasukan::query()->select(['pemasukan.santri_id', 'payment_date'])
            ->where('pemasukan.id', $id)
            ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
            ->join('iuran', 'santri.id', '=', 'iuran.santri_id')
            ->first();

        if($pemasukan !== null) {
            Iuran::query()->where('santri_id', $pemasukan->santri_id)
                ->where('date', Carbon::parse($pemasukan->payment_date)->format('Y-m-d'))
                ->delete();
        }

        $santri_id = Pemasukan::query()->select(['santri_id'])->where('id', $id)->first();
        $detailPaidIurans = Pemasukan::query()->select(['iuran', 'amount', 'santri_id'])
            ->join('detail_pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
            ->where('pemasukan.id', $id)
            ->whereMonth('payment_date', Carbon::now()->format('m'))
            ->whereYear('payment_date', Carbon::now()->format('Y'))
            ->get();

        foreach ($detailPaidIurans as $detail) {
            Iuran::query()
                ->where('santri_id', $santri_id->santri_id)
                ->decrement($detail->iuran, $detail->amount);

            Saldo::query()->where('iuran', $detail->iuran)->decrement('amount', $detail->amount);
        }

        return Pemasukan::query()->findOrFail($id)->delete();
    }

    public function getRiwayatPemasukans(): JsonResponse {
        $pemasukans = Pemasukan::query()->select(['pemasukan.id', 'santri.name', 'payment_code', 'total_payment', 'payment_date', 'status'])->distinct()
            ->join('detail_pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
            ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
            ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
            ->where('wali_santri.email', auth()->user()->email);

        return DataTables::of($pemasukans)
            ->addIndexColumn()
            ->editColumn('name', function($data) {
                return ' '.$data->name;
            })
            ->editColumn('total_payment', function($data) {
                return Number::currency($data->total_payment, 'IDR');
            })
            ->editColumn('status', function($data) {
                return $data->status == 'lunas' ? "<div class='badge badge-success'>Lunas</div>" : "<div class='badge badge-danger'>Belum Lunas</div>";
            })
            ->rawColumns(['status'])
            ->make(true);
    }
}