<?php

namespace App\Services\Implementations;

use App\Models\Cicilan;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Contracts\CicilanService;

class CicilanServiceImp implements CicilanService
{
    public function getCicilans(): \Illuminate\Http\JsonResponse {
        $query = Cicilan::query()->select(['cicilan.id', 'cicilan_date', 'santri.name', 'amount', 'iuran', 'month', 'year'])
            ->join('santri', 'cicilan.santri_id', '=', 'santri.id')
            ->whereMonth('cicilan_date', date('m'))
            ->whereYear('cicilan_date', date('Y'));

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('amount', function($data) {
                return Number::currency($data->amount, 'IDR');
            })
            ->editColumn('iuran', function($data) {
                return $data->iuran === 'gas_minyak' ? 'Gas & Minyak' : ucfirst($data->iuran);
            })
            ->editColumn('tempo', function ($data) {
                return $data->month.' '.$data->year;
            })
            ->addColumn('action', function ($data) {
                return (
                    // '<button class="btn btn-action btn-primary mr-1 btn-edit" id="'.$data->id.'" data-toggle="modal" data-target="#editModal">
                    //     <i class="far fa-edit"></i>
                    // </button>'.
                    '<button class="btn btn-action btn-danger mr-1 btn-delete" id="'.$data->id.'"><i class="fas fa-trash"></i></button>'.
                    '<button class="btn btn-action btn-info btn-detail"><i class="fas fa-info-circle"></i></button>'
                );
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function createCicilan(array $data): bool
    {
        return Cicilan::query()->insert($data);
    }

    public function checkSantriCicilan(int $id): Cicilan|\Illuminate\Database\Eloquent\Collection
    {
        return Cicilan::query()->select(['cicilan_date', 'amount', 'iuran', 'santri.name'])
            ->join('santri', 'cicilan.santri_id', '=', 'santri.id')
            ->get();
    }

    public function getCicilan(string $id)
    {
        return Cicilan::query()->find($id);
    }
}