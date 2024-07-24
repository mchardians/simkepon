<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Iuran;
use App\Models\Saldo;
use App\Models\Santri;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use App\Models\DetailPemasukan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function admin() {
        $totalSantri = Santri::count();
        $santriwan = Santri::query()->where('gender', '=', 'laki-laki')->count();
        $santriwati = Santri::query()->where('gender', '=', 'perempuan')->count();

        return view('pages.admin.dashboard', ['santriwan' => $santriwan, 'santriwati' => $santriwati, 'totalSantri' => $totalSantri]);
    }

    public function bendahara() {
        if(request()->ajax()) {
            $iurans = [
                'masak',
                'gas_minyak',
                'kas',
                'tabungan',
                'bisaroh',
                'transport',
                'darurat'
            ];

            $nominalIurans = [
                'masak' => 120000,
                'gas_minyak' => 20000,
                'kas' => 10000,
                'tabungan' => 10000,
                'bisaroh' => 15000,
                'transport' => 10000,
                'darurat' => 15000
            ];

            if(request()->has('santri_id')) {
                $query = Santri::query()->select(['id', 'name'])
                    ->where('santri.id', request()->santri_id)->first();

                $detailIurans = DetailPemasukan::query()->select(['iuran'])
                    ->join('pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
                    ->where('santri_id', request()->santri_id)->get()->toJson();

                $detailIurans = json_decode($detailIurans);

                $result = [];

                foreach ($detailIurans as $key => $value) {
                    if($value->iuran) {
                        $result[] = $value->iuran;
                    }
                }

                $result = array_diff($iurans, $result);

                $iuransBelumLunas = [];

                foreach ($result as $key => $value) {
                    $iuransBelumLunas[] = [
                        'iuran' => $value,
                        'nominal' => $nominalIurans[$value]
                    ];
                }

                return response()->json([
                    'iurans' => $iuransBelumLunas,
                ]);
            }

            $query = Santri::query()->select(['santri.id', 'nis', 'name', 'iuran'])
                ->leftJoin('pemasukan', 'santri.id', '=', 'pemasukan.santri_id')
                ->leftJoin('detail_pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
                ->whereDoesntHave('pemasukan')
                ->orWhere('pemasukan.status', '=', 'belum_lunas')
                ->whereMonth('payment_date', date('m'))
                ->whereYear('payment_date', date('Y'));

            $containers = json_decode($query->get()->toJson());
            $result = [];

            foreach ($containers as $key => $value) {
                $key = $value->name . '_' . $value->nis;
                if (!isset($result[$key])) {
                    $result[$key] = [
                        'id' => $value->id,
                        'nis' => $value->nis,
                        'name' => $value->name,
                        'iuran' => [],
                        'total' => 0,
                    ];
                }

                if ($value->iuran) {
                    $result[$key]['iuran'][] = $value->iuran;
                }
            }

            foreach ($result as $key1 => $values) {
                $totalIuranBelumLunas = 0;
                $belumLunas = array_diff($iurans, $values['iuran']);

                foreach ($belumLunas as $value) {
                    $totalIuranBelumLunas += $nominalIurans[$value];
                }

                $result[$key1]['iuran'] = $belumLunas;
                $result[$key1]['total'] = $totalIuranBelumLunas;
            }

            return DataTables::of(collect($result))
                ->addIndexColumn()
                ->editColumn('nis', function($row) {
                    return " " . $row['nis'];
                })
                ->addColumn('total', function($row) {
                    return Number::currency($row['total'], 'IDR');
                })
                ->make(true);
        }

        $saldos = Saldo::query()->select(['iuran', 'amount'])->get()->toArray();

        $totalSantri = Santri::count();
        $santriLunas = Santri::query()->join('pemasukan', 'santri.id', '=', 'pemasukan.santri_id')
            ->where('pemasukan.status', '=', 'lunas')
            ->whereMonth('payment_date', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->count();
        $santriBelumLunas = Santri::query()->leftJoin('pemasukan', 'santri.id', '=', 'pemasukan.santri_id')
            ->whereDoesntHave('pemasukan')
            ->orWhere('pemasukan.status', '=', 'belum_lunas')
            ->whereMonth('payment_date', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->count();

        $lunas = round((($santriLunas / $totalSantri) * 100), 2);
        $belumLunas = round((($santriBelumLunas / $totalSantri) * 100), 2);

        return view('pages.bendahara.dashboard', compact(
            [
                'saldos', 'lunas', 'belumLunas', 'santriLunas', 'santriBelumLunas'
                ]
        ));
    }

    public function walisantri() {
        if(request()->ajax()) {
            $query = DetailPemasukan::query()->select(['santri.name', 'month', 'year', 'amount'])
                ->join('pemasukan', 'detail_pemasukan.pemasukan_id', '=', 'pemasukan.id')
                ->join('santri', 'pemasukan.santri_id', '=', 'santri.id')
                ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
                ->where('iuran', 'tabungan')
                ->where('wali_santri.email', '=', auth()->user()->email);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('amount', function($data) {
                    return Number::currency($data->amount, 'IDR');
                })
                ->addColumn('tempo', function($data) {
                    return $data->month.' '.$data->year;
                })
                ->make(true);
        }

        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();
        $startOfLastMonth = $today->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $today->copy()->subMonth()->endOfMonth();

        $tabungans = Santri::query()
        ->select([
            'santri.name',
            DB::raw('SUM(iuran.tabungan) as total_tabungan'),
            DB::raw('SUM(CASE WHEN iuran.date >= "' . $startOfMonth . '" THEN iuran.tabungan ELSE 0 END) as tabungan_bulan_ini'),
            DB::raw('SUM(CASE WHEN iuran.date >= "' . $startOfLastMonth . '" AND iuran.date <= "' . $endOfLastMonth . '" THEN iuran.tabungan ELSE 0 END) as tabungan_bulan_lalu'),
        ])
        ->leftJoin('iuran', 'iuran.santri_id', '=', 'santri.id')
        ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
        ->where('wali_santri.email', '=', auth()->user()->email)
        ->groupBy('santri.id', 'santri.name')
        ->get();
        
        return view('pages.walisantri.dashboard', [
            'tabungans' => $tabungans,
        ]);
    }

    public function kepalapondok() {
        if(request()->ajax()) {
            $query = Santri::query()->select(['nis', 'name'])->leftJoin('pemasukan', 'santri.id', '=', 'pemasukan.santri_id')
                ->whereDoesntHave('pemasukan')
                ->orWhere('pemasukan.status', '=', 'belum_lunas')
                ->whereMonth('payment_date', date('m'))
                ->whereYear('payment_date', date('Y'));

            return DataTables::of($query)
                ->addIndexColumn()
                ->make(true);
        }

        $saldos = Saldo::query()->select(['iuran', 'amount'])->get()->toArray();

        $saldoBantuan = Saldo::query()->select(['amount'])
            ->where('iuran', 'kas')
            ->orWhere('iuran', 'darurat')->get()->toArray();
        $saldoBantuan = $saldoBantuan[0]["amount"] + $saldoBantuan[1]["amount"];
        $totalPengeluaran = Pengeluaran::query()->whereMonth('date', date('m'))->sum('amount');

        return view('pages.kepala-pondok.dashboard', compact('saldos', 'saldoBantuan', 'totalPengeluaran'));
    }
}
