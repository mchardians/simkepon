<?php

namespace App\Http\Controllers;

use App\Models\DetailPemasukan;
use Exception;
use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Contracts\IuranService;
use App\Services\Contracts\SantriService;
use Illuminate\Support\Facades\Validator;
use App\Services\Contracts\PemasukanService;
use App\Services\Contracts\SaldoService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PembayaranController extends Controller
{
    private $santriService;
    private $pemasukanService;
    private $iuranService;
    private $saldoService;

    public function __construct(
            PemasukanService $pemasukanService, SantriService $santriService,
            IuranService $iuranService, SaldoService $saldoService
        ) {
        $this->pemasukanService = $pemasukanService;
        $this->santriService = $santriService;
        $this->iuranService = $iuranService;
        $this->saldoService = $saldoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santris = Santri::query()->select(['id', 'name', 'nis', 'picture'])->get();

        if(request()->has('santri')) {
            $santris = $this->santriService->showSantrisByNameOrNis(request()->get('santri'));

            return response()->json([
                "success" => true,
                "data" => $santris,
            ], 200);
        }

        if(request()->ajax()) {
            if(request()->has('id')) {
                return response()->json([
                   "data" => $this->santriService->findSantri(request()->get('id')),
                ]);
            }
        }

        return view('pages.bendahara.pembayaran-santri', compact( 'santris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $nis)
    {
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $iuran = [
            "masak" => 120000,
            "gas_minyak" => 20000,
            "kas" => 10000,
            "tabungan" => 10000,
            "bisaroh" => 15000,
            "transport" => 10000,
            "darurat" => 15000
        ];

        $santris = Santri::query()->select(['id', 'nis', 'name'])->where('nis', $nis)->first();
        $isLunas = Pemasukan::query()->select(['month', 'year', 'amount', 'iuran'])
                ->join('detail_pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
                ->where('pemasukan.santri_id', $santris->id)
                ->get();

        if(request()->ajax()) {
            if(request()->has('year')) {
                return response()->json([
                    "isLunas" => $isLunas,
                ]);
            }
        }

        return view('pages.bendahara.pembayaran-iuran', compact('months', 'iuran', 'santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $nis)
    {
        try {
            $validator = Validator::make($request->all(), [
                'datas.*.month' => 'required|string',
                'datas.*.year' => 'required|string',
                'datas.*.amount' => 'required|integer',
                'datas.*.iuran' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ]);
            }

            $santriId = Santri::query()->select('id')->where('nis', $nis)->first();

            if(!$santriId) {
                return response()->json([
                    'errors' => 'Santri not found'
                ]);
            }

            $total = 0;
            $status = 'belum_lunas';

            $datas = [];

            $iuranDefaultAmount = [
                "masak" => 0,
                "gas_minyak" => 0,
                "kas" => 0,
                "tabungan" => 0,
                "bisaroh" => 0,
                "transport" => 0,
                "darurat" => 0,
                "date" => Carbon::now('Asia/Jakarta')->format("Y-m-d"),
                "santri_id" => $santriId->id,
                "created_at" => Carbon::now('Asia/Jakarta')->format("Y-m-d H:i:s"),
            ];

            foreach($validator->validated()['datas'] as $item) {
                array_push($datas, $item);

                if(isset($iuranDefaultAmount[$item["iuran"]])) {
                    $iuranDefaultAmount[$item["iuran"]] = $item["amount"];
                }

                $total += $item["amount"];
            }

            if($total === 200000) {
                $status = 'lunas';
            }

            $data = [
                "payment_code" => "INV-". date('ym').str_pad((Pemasukan::query()->latest('id')->first()->id ?? 0) + 1, 6, '0', STR_PAD_LEFT),
                "total_payment" => $total,
                "payment_date" => Carbon::now('Asia/Jakarta')->format("Y-m-d H:i:s"),
                "status" => $status,
                "santri_id" => $santriId->id,
                "created_at" => Carbon::now('Asia/Jakarta')->format("Y-m-d H:i:s"),
            ];

            DB::beginTransaction();

            $pemasukan_id = $this->pemasukanService->createPemasukan($data);

            if (!$pemasukan_id) {
                throw new HttpException(422, "Gagal menyimpan data pemasukan.");
            }

            $this->pemasukanService->createDetailPemasukan($datas, $pemasukan_id);

            $this->iuranService->createIuran($iuranDefaultAmount);

            foreach($iuranDefaultAmount as $iuran => $value) {
                $this->saldoService->increaseBalance($iuran, (int) $value);
            }

            DB::commit();

            return response()->json([
                "message" => "Pembayaran berhasil dilakukan.",
                "redirect" => route('bendahara.santri.pembayaran')
            ]);
        } catch (HttpException $e) {
            DB::rollBack();

            return response()->json([
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

    public function riwayat() {
        if(request()->ajax()) {
            if(request()->has('pemasukan_id')) {
                $detailPemasukan = DetailPemasukan::query()->select(['month', 'year', 'amount', 'iuran'])
                    ->join('pemasukan', 'detail_pemasukan.pemasukan_id', '=', 'pemasukan.id')
                    ->where('pemasukan_id', request()->get('pemasukan_id'))
                    ->get();

                return response()->json([
                    'success' => true,
                    'data' => $detailPemasukan
                ]);
            }

            return $this->pemasukanService->getRiwayatPemasukans();
        }

        return view('pages.walisantri.riwayat-pembayaran');
    }
}
