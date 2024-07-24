<?php

namespace App\Services\Implementations;

use Carbon\Carbon;
use App\Models\Saldo;
use App\Models\Pengeluaran;
use Illuminate\Support\Number;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Contracts\PengeluaranService;

class PengeluaranServiceImp implements PengeluaranService {
    public function getPengeluarans(string $startDate = null, string $endDate = null): JsonResponse {
        $query = Pengeluaran::query()->select(['id', 'date', 'amount', 'iuran', 'description'])
            ->orderBy('created_at', 'desc');

        if($startDate !== null && $endDate !== null) {
            $query = $query->whereBetween('date', [
                Carbon::parse($startDate)->startOfDay()->toDateTimeString(),
                Carbon::parse($endDate)->endOfDay()->toDateTimeString()
            ]);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('amount', function ($data) {
                return Number::currency($data->amount, 'IDR');
            })
            ->editColumn('iuran', function($data) {
                return $data->iuran === 'gas_minyak' ? 'Gas & Minyak' : ucfirst($data->iuran);
            })
            ->editColumn('date', function ($data) {
                return date('d F Y', strtotime($data->date));
            })
            ->addColumn('action', function ($data) {
                if(auth()->user()->role->name == 'kepalapondok') {
                    return '<button class="btn btn-action btn-danger btn-delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>';
                }

                return (
                    '<button class="btn btn-action btn-primary mr-1 btn-edit" id="'.$data->id.'" data-toggle="modal" data-target="#editModal">
                        <i class="far fa-edit"></i>
                    </button>'
                );
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createKeuanganKeluar(array $data): bool {
        $pengeluaran = new Pengeluaran();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $pengeluaran->fill($data);

        $saldo = Saldo::query()->where('iuran', $data['iuran'])->first();
        $result = ($saldo->amount - $data['amount']);

        if($result < 0) {
            return false;
        }

        $saldo->decrement('amount', $data['amount']);

        return $pengeluaran->save();
    }

    public function getKeuanganKelarById(int $id): Pengeluaran {
        return Pengeluaran::findOrFail($id);
    }

    public function updateKeuanganKeluar(int $id, array $data): bool {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $data['date'] = date('Y-m-d', strtotime($data['date']));

        $saldo = Saldo::query()->where('iuran', $pengeluaran->iuran)->first();

        if($data['amount'] > $pengeluaran->amount) {
            $result = ($data['amount'] - $pengeluaran->amount);

            if($result < 0) {
                return false;
            }

            $saldo->decrement('amount', $result);

            $pengeluaran->fill($data);
            return $pengeluaran->save();
        }

        $result = ($pengeluaran->amount - $data['amount']);

        $saldo->increment('amount', $result);

        $pengeluaran->fill($data);

        return $pengeluaran->save();
    }

    public function deleteKeuanganKeluar(int $id): bool {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $saldo = Saldo::query()->where('iuran', $pengeluaran->iuran)->first();
        $saldo->increment('amount', $pengeluaran->amount);

        return $pengeluaran->delete();
    }
}