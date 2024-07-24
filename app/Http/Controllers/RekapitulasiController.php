<?php

namespace App\Http\Controllers;

use App\Services\Contracts\IuranService;

class RekapitulasiController extends Controller
{
    private $iuranService;

    public function __construct(IuranService $iuranService) {
        $this->iuranService = $iuranService;
    }

    public function index() {
        if(request()->ajax()) {
            if(request()->has('date')) {
                return $this->iuranService->getIurans(request()->get('date'));
            }
            return $this->iuranService->getIurans();
        }

        return view('pages.bendahara.rekapitulasi');
    }

    public function rekapitulasiSantri() {

        if(request()->ajax()) {
            if(request()->has('date')) {
                return $this->iuranService->getIurans(request()->get('date'));
            }

            return $this->iuranService->getIurans();
        }

        return view('pages.walisantri.rekapitulasi');
    }
}
