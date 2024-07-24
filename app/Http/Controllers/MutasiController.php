<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MutasiController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {

            if(request()->has('source_iuran')) {
                if(request()->get('source_iuran') === null) {
                    return response()->json([
                        'amount' => 0
                    ]);
                }

                $source_iuran = Saldo::query()->where('iuran', request()->get('source_iuran'))->first();
                return response()->json([
                    "amount" => $source_iuran->amount
                ]);
            }

            $query = Mutasi::query()->select(['iuran', 'amount', 'date', 'source_iuran']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('iuran', function($data) {
                    return $data->iuran === "gas_minyak" ? "Gas Minyak" : ucwords($data->iuran);
                })
                ->editColumn('amount', function($data) {
                    return Number::currency($data->amount, 'IDR');
                })
                ->make(true);
        }

        return view('pages.bendahara.riwayat-mutasi');
    }

    public function transfer(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'iuran' => 'required|in:masak,gas_minyak,kas,tabungan,bisaroh,transport,darurat',
                'source_iuran' => 'required|in:kas,darurat'
            ]);

            if($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $data = $validator->validated();
            $data["outcome"] = str_replace(',', '', $request->get('outcome'));

            $outcome = $data["outcome"];
            $saldoIuran = Saldo::query()->where('iuran', $data['iuran'])->first();
            $saldoSumber = Saldo::query()->where('iuran', $data['source_iuran'])->first();

            if(($saldoSumber->amount <= 0)) {
                return response()->json([
                    "errors" => [
                        "source_iuran" => "Saldo sumber iuran tidak mencukupi."
                    ]
                ]);
            }

            $result = ($outcome - $saldoIuran->amount);

            $saldoIuran->increment('amount', $result);
            $saldoSumber->decrement('amount', $result);

            Mutasi::query()->create([
                'iuran' => $data['iuran'],
                'amount' => $result,
                'source_iuran' => $data['source_iuran'],
            ]);

            return response()->json([
                "success" => true,
                "status" => 200,
                "message" => "Transfer iuran success!",
            ]);

        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    public function riwayat() {

        return view('pages.bendahara.riwayat-mutasi');
    }
}
