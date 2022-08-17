<?php

namespace Database\Seeders;

use App\Models\Ayat;
use App\Models\Surat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class AyatSeeder extends Seeder
{
    protected $ayat;
    protected $surat;

    public function __construct()
    {
        $this->ayat = new Ayat();
        $this->surat = new Surat();
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
        foreach ($surats as $i => $surat) {
            $urlAyat = env('APP_QURAN_URL') . "/api/v1/ayatweb/$surat->order/0/0/300";
            $requestAyat = Http::retry(3, 60000)->get($urlAyat);
            if ($requestAyat->successful()) {
                $responseAyat = (object) $requestAyat->json();
                $responseDataAyat = $responseAyat->data;
                foreach ($responseDataAyat as $k => $ayat) {
                    $dataAyat = (object) $ayat;
                    $ayatId = Str::uuid();

                    $this->ayat->create([
                        'id' => $ayatId,
                        'order' => $k + 1,
                        'topic' => $dataAyat->tema,
                        'text' => $dataAyat->teks_ayat,
                        'text_translate' => $dataAyat->teks_terjemah,
                        'text_notes' => $dataAyat->teks_fn,
                        'surat_id' => $surat->id,
                    ]);
                }
                $countSuccess++;
                (new ConsoleOutput())->writeln(($i + 1) . ". $urlAyat : success");
            } else {
                $countFailed++;
                (new ConsoleOutput())->writeln(($i + 1) . ". $urlAyat : failed");
            }
            $count++;

        }
        (new ConsoleOutput())->writeln("Jumlah Surat Failed $countFailed");
        (new ConsoleOutput())->writeln("Jumlah Surat Success $countSuccess");
        (new ConsoleOutput())->writeln("Jumlah Surat $count");
        (new ConsoleOutput())->writeln("");
    }
}
