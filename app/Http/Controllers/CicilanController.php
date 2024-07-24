<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Iuran;
use App\Models\Santri;
use App\Models\Cicilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Contracts\CicilanService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CicilanController extends Controller
{
    private $cicilanService;

    public function __construct(CicilanService $cicilanService) {
        $this->cicilanService = $cicilanService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            if(request()->has('santri')) {
                return $this->cicilanService->checkSantriCicilan(request()->get('santri'));
            }

            return $this->cicilanService->getCicilans();
        }

        return view('pages.bendahara.cicilan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if(request()->ajax()) {
                if(request()->has('santri')) {
                    $iuranSantri = Iuran::query()->select(['masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])
                        ->where('santri_id', request()->get('santri'))
                        ->first();

                    return response()->json([
                        "success" => true,
                        "data" => $iuranSantri
                    ]);
                }

                $santris = Santri::query()->select(['santri.id', 'nis', 'name'])
                    ->leftJoin('pemasukan', 'santri.id', '=', 'pemasukan.santri_id')
                    ->whereDoesntHave('pemasukan')
                    ->orWhere('status', '=', 'belum_lunas')
                    ->whereMonth('payment_date', date('m'))
                    ->whereYear('payment_date', date('Y'))
                    ->get();

                return response()->json([
                    "success" => true,
                    "data" => $santris
                ], 200);
            }

            return;
        } catch (HttpException $e) {
            return response()->json([
                "success" => false,
                "status" => $e->getStatusCode(),
                "message" => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $iuran = [
                "masak" => 120000,
                "gas_minyak" => 20000,
                "kas" => 10000,
                "tabungan" => 10000,
                "bisaroh" => 15000,
                "transport" => 10000,
                "darurat" => 15000
            ];

            $data = $request->all();
            $data['amount'] = str_replace(',', '', $data['amount']);

            $validator = Validator::make($data, [
                'santri_id' => 'required|exists:santri,id',
                'amount' => 'required|integer',
                'tempo' => 'required',
                'iuran' => 'required',
                'description' => 'required'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }

            $data = $validator->validated();

            list($month, $year) = explode(' ', $data['tempo']);
            unset($data['tempo']);

            $data['cicilan_date'] = Carbon::now()->format('Y-m-d');
            $data['month'] = $month;
            $data['year'] = $year;

            $isSuccess = $this->cicilanService->createCicilan($data);

            if(!$isSuccess) {
                throw new HttpException(422, 'Gagal menambahkan data cicilan.');
            }

            return response()->json([
                "success" => $isSuccess,
                "status" => 200,
                "message" => "Cicilan created successfully!",
            ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
