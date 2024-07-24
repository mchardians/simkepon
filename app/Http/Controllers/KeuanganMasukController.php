<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Models\DetailPemasukan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Services\Contracts\PemasukanService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KeuanganMasukController extends Controller
{
    private $pemasukanService;

    public function __construct(PemasukanService $pemasukanService) {
        $this->pemasukanService = $pemasukanService;
    }

    public function index() {
        if(request()->ajax()) {
            if(request()->has('id')) {
                return response()->json([
                    "data" => $this->pemasukanService->getDetailPemasukans(request()->get('id')),
                ]);
            }

            if(request()->has('status') || (request()->has('startDate') && request()->has('endDate'))) {
                if(request()->status !== null || (request()->startDate !== null && request()->endDate !== null)) {
                    return $this->pemasukanService->getPemasukans(request()->status, request()->startDate, request()->endDate);
                }
            }

            return $this->pemasukanService->getPemasukans();
        }

        return view('pages.bendahara.keuangan-masuk');
    }

    public function show(string $id) {
        $pemasukan = Pemasukan::query()->select([
            'payment_code', 'total_payment', 'payment_date', 'status', 'pemasukan.created_at',
            'santri.nis', 'santri.name', 'wali_santri.name as wali_name',
            'wali_santri.phone as wali_phone', 'wali_santri.email as wali_email', 'wali_santri.address as wali_address',
            ])
            ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
            ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
            ->findOrFail($id);

        $detail_pemasukan = DetailPemasukan::query()->select(['iuran', 'month', 'year', 'amount'])
            ->where('pemasukan_id', '=', $id)->get();

        preg_match('/^([^,]+)/', $pemasukan->wali_address, $jalan_matches);
        $jalan = $jalan_matches[1] ?? "";
        preg_match('/(Kec\.\s[^,]+)/', $pemasukan->wali_address, $kecamatan_matches);
        $kecamatan = $kecamatan_matches[1] ?? "";
        preg_match('/(Kota|Kabupaten)\s[^,]+/', $pemasukan->wali_address, $kota_kabupaten_matches);
        $kota_kabupaten = $kota_kabupaten_matches[0] ?? "";

        return view('pages.bendahara.bukti-pembayaran', compact('pemasukan', 'detail_pemasukan', 'jalan', 'kecamatan', 'kota_kabupaten'));
    }

    public function send(Request $request) {
        try {

            if($request->hasFile('media')) {
                $validator = Validator::make($request->all(), [
                    'phone' => 'required|min:10|max:13',
                    'media' => 'required|mimes:pdf|max:1024'
                ]);

                if($validator->fails()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $validator->errors()->first()
                    ]);
                }

                $url = 'http://localhost:3000/api/v1/send-media';

                $response = Http::attach('media', $request->file('media')->get(), $request->file('media')->getClientOriginalName())
                            ->post($url, [
                                'number' => $request->get('phone'),
                                'message' => 'Terima kasih telah membayar iuran perbulan di PPMQ Jantiko Mantab. Silahkan baca bukti pembayaran dibawah ini. Terima kasih.'
                            ]);

                if($response->successful()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => $response->body()
                    ]);
                }
            }

            throw new Exception('The media field is required.');
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id) {
        try {
            $isSuccess = $this->pemasukanService->deletePemasukan($id);

            if (!$isSuccess) {
                throw new HttpException(422, 'Failed to delete pemasukan');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pemasukan deleted successfully'
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
        return view('pages.bendahara.laporan-keuangan-masuk');
    }

    public function reportKepalaPondok() {
        if(request()->ajax()) {
            if(request()->has('startDate') && request()->has('endDate')) {
                return $this->pemasukanService->getPemasukans(null, request()->get('startDate'), request()->get('endDate'));
            }

            return $this->pemasukanService->getPemasukans();
        }

        return view('pages.kepala-pondok.laporan-keuangan-masuk');
    }
}
