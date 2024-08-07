<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Santri;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RemindKepalaPondok extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:kepalapondok';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder message via Whatsapp to Kepala Pondok';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "http://localhost:3000/api/v1/send-message";
        $message = "Assalamualaikum warahmatullahi wabarakatuh.\n\nKepada Kepala Pondok Pesantren Murottilil Qur-an Jantiko Mantab,\nBerdasarkan hasil rekap bulanan iuran santri, berikut kami sampaikan daftar santri belum melunasi iuran pada bulan ini:\n\n";

        $query = Santri::query()->select(['nis', 'santri.name'])
            ->leftJoin('pemasukan', 'pemasukan.santri_id', '=', 'santri.id')
            ->join('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
            ->whereDoesntHave('pemasukan')
            ->orWhere('pemasukan.status', '=', 'belum_lunas')
            ->where('payment_date', Carbon::now()->format('Y-m-d'))
            ->get()->toJson();

        $santriBelumLunas = json_decode($query);
        foreach ($santriBelumLunas as $key => $value) {
            $message .= $key+1 . ". " . $value->name ." (".$value->nis.")". "\n";
        }

        $message .= "\nInformasi lebih lanjut dapat diakses pada halaman berikut:\nhttp://localhost:8000/user/login\n\nCredentials sebagai berikut:\n\nEmail: admin@simkepon.app\nPassword: rahasia\n\nDemikian informasi yang dapat kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.";

        $response = Http::post($url, [
            'number' => 'your phone number',
            'message' => $message
        ]);

        if($response->successful()) {
            Log::info($response->body());
        }
    }
}
