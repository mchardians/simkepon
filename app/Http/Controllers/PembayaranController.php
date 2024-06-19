<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $iuran = [
            "masak" => 120000,
            "gas_minyak" => 20000,
            "kas" => 10000,
            "tabungan" => 10000,
            "bisaroh" => 15000,
            "transport" => 10000,
            "darurat" => 10000
        ];

        $santris = Santri::query()->select(['id', 'nis', 'name', 'picture'])->get();

        if(request()->has('query')) {
            return response()->json($santris);
        }

        return view('pages.bendahara.pembayaran', compact('months', 'iuran', 'santris'));
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
        //
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
