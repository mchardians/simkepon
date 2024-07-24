<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Pemasukan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class RemindWaliSantri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:walisantri';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder message via Whatsapp to Wali Santri';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "http://localhost:3000/api/v1/send-bulk-message";

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

        $query = Santri::query()->select(['wali_santri.name', 'wali_santri.phone', 'santri.name as santri_name', 'iuran'])
            ->leftJoin('pemasukan', 'pemasukan.santri_id', '=', 'santri.id')
            ->leftJoin('detail_pemasukan', 'pemasukan.id', '=', 'detail_pemasukan.pemasukan_id')
            ->leftJoin('wali_santri', 'santri.wali_santri_id', '=', 'wali_santri.id')
            ->whereDoesntHave('pemasukan')
            ->orWhere('pemasukan.status', 'belum_lunas')
            ->whereMonth('payment_date', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->get()->toJson();

        $walisantriInfo = json_decode($query);

        $result = [];

        foreach ($walisantriInfo as $key => $value) {
            $key = $value->name . '_' . $value->phone;

            if(!isset($result[$key])) {
                $result[$key] = [
                    'name' => $value->name,
                    'phone' => $value->phone,
                    'santri_name' => $value->santri_name,
                    'iuran' => []
                ];
            }

            if($value->iuran) {
                $result[$key]['iuran'][] = $value->iuran;
            }
        }

        $message = "";

        foreach ($result as $key => $value) {
            $result[$key]['iuran'] = array_diff($iurans, $value['iuran']);
        }

        $phones = [];
        $messages = [];
        $counter = 0;

        foreach ($result as $key => $values) {
            array_push($phones, $values['phone']);
            $message = "Assalamualaikum warahmatullahi wabarakatuh.\n\nKepada Yth. {$values['name']}, selaku wali santri dari {$values['santri_name']},\n\nKami dari tim bendahara Pondok Pesantren Murottilil Qur-an Jantiko Mantab menginformasikan terkait tunggakan iuran santri yang belum lunas dibayarkan.\n\nAdapun rinciannya sebagai berikut:\n\n";

            foreach($result[$key]['iuran'] as $index => $iuran) {
                $counter += 1;

                if($iuran === "gas_minyak") {
                    $message .= $counter. '. ' . "Gas minyak" . " : " . (new \NumberFormatter('ID', \NumberFormatter::CURRENCY))->formatCurrency($nominalIurans[$iuran], 'IDR') ."\n";
                }else {
                    $message .= $counter. '. ' . ucwords($iuran) . " : " . (new \NumberFormatter('ID', \NumberFormatter::CURRENCY))->formatCurrency($nominalIurans[$iuran], 'IDR') ."\n";
                }

            }

            $counter = 0;

            $message .= "\nDemikian informasi yang dapat kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.";

            array_push($messages, $message);
        }

        $response = Http::timeout(120)->post($url, [
            'numbers' => $phones,
            'messages' => $messages
        ]);

        if($response->successful()) {
            Log::info($response->body());
        }
    }
}
