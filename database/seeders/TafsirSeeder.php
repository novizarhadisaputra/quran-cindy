<?php

namespace Database\Seeders;

use App\Models\Ayat;
use App\Models\Surat;
use App\Models\Tafsir;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class TafsirSeeder extends Seeder
{
    protected $ayat;
    protected $surat;
    protected $tafsir;

    public function __construct()
    {
        $this->ayat = new Ayat();
        $this->surat = new Surat();
        $this->tafsir = new Tafsir();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surats = $this->surat->all();
        $count = 0;
        $countSuccess = 0;
        $countFailed = 0;
        foreach ($surats as $surat) {
            (new ConsoleOutput())->writeln("Tafsir Surat $surat->name : ");
            foreach ($surat->ayats as $ayat) {
                $urlTafsir = env('APP_QURAN_URL') . '/api/v1/tafsirbyayat/' . ($count + 1);
                $requestTafsir = Http::retry(3, 60000)->get($urlTafsir);
                if ($requestTafsir->successful()) {
                    $responseTafsir = (object) $requestTafsir->json();
                    $responseDataTafsir = json_decode(json_encode($responseTafsir->tafsir));

                    $tafsirId = Str::uuid();
                    $this->tafsir->create([
                        'id' => $tafsirId,
                        'ayat_id' => $ayat->id,
                        'tafsir_wajiz' => $responseDataTafsir[0]->tafsir_wajiz,
                        'tafsir_tahlili' => $responseDataTafsir[0]->tafsir_tahlili,
                    ]);
                    $countSuccess++;
                    (new ConsoleOutput())->writeln("Tafsir Ayat $urlTafsir : Success");
                } else {
                    $countFailed++;
                    (new ConsoleOutput())->writeln("Tafsir Ayat $urlTafsir : Failed");
                }
                $count++;
            }
            (new ConsoleOutput())->writeln("");
        }
        (new ConsoleOutput())->writeln("Jumlah Ayat Failed $countFailed");
        (new ConsoleOutput())->writeln("Jumlah Ayat Success $countSuccess");
        (new ConsoleOutput())->writeln("Jumlah Ayat $count");
        (new ConsoleOutput())->writeln("==============================================");
        (new ConsoleOutput())->writeln("");
    }
}
