<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Contracts\PengeluaranService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KeuanganKeluarController extends Controller
{
    private $pengeluaranService;
    public function __construct(PengeluaranService $pengeluaranService) {
        $this->pengeluaranService = $pengeluaranService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            if(request()->has('iuran')) {
                $iuran = Saldo::query()->where('iuran', request()->get('iuran'))->first();
                return response()->json([
                    "amount" => $iuran->amount
                ]);
            }

            if(request()->has('startDate') && request()->has('endDate')) {
                return $this->pengeluaranService->getPengeluarans(request()->startDate, request()->endDate);
            }

            return $this->pengeluaranService->getPengeluarans();
        }

        return view('pages.bendahara.keuangan-keluar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['amount'] = str_replace(',', '', $data['amount']);

            $validator = Validator::make($data, [
                'date' => 'required|date',
                'amount' => 'required|numeric|gt:0',
                'iuran' => 'required|in:masak,gas_minyak,kas,tabungan,bisaroh,transport,darurat',
                'description' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->pengeluaranService->createKeuanganKeluar($validator->validated());

            if (!$isSuccess) {
                throw new HttpException(422, "Failed to create keuangan keluar");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Pengeluaran created successfully.",
            ], 200);

        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $keuanganKeluar = $this->pengeluaranService->getKeuanganKelarById($id);

            return response()->json([
                "success" => true,
                "status" => 200,
                "data" => $keuanganKeluar
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->all();
            $data['amount'] = str_replace(',', '', $data['amount']);

            $validator = Validator::make($data, [
                'date' => 'required|date',
                'amount' => 'required|numeric|gt:0',
                'iuran' => 'required|in:masak,gas_minyak,kas,tabungan,bisaroh,transport,darurat',
                'description' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    "errors" => $validator->errors()
                ]);
            }

            $isSuccess = $this->pengeluaranService->updateKeuanganKeluar($id, $validator->validated());

            if (!$isSuccess) {
                throw new HttpException(422, "Failed to update keuangan keluar");
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Pengeluaran updated successfully.",
            ], 200);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isSuccess = $this->pengeluaranService->deleteKeuanganKeluar($id);

            if (!$isSuccess) {
                throw new HttpException(422, 'Gagal menghapus data keuangan keluar');
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Pengeluaran deleted successfully!",
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    public function report() {
        return view('pages.bendahara.laporan-keuangan-keluar');
    }

    public function reportKepalaPondok() {
        if(request()->ajax()) {
            if(request()->has('startDate') && request()->has('endDate')) {
                return $this->pengeluaranService->getPengeluarans(request()->get('startDate'), request()->get('endDate'));
            }

            return $this->pengeluaranService->getPengeluarans();
        }

        return view('pages.kepala-pondok.laporan-keuangan-keluar');
    }
}
