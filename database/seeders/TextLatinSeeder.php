<?php

namespace Database\Seeders;

use App\Models\Ayat;
use App\Models\Surat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class TextLatinSeeder extends Seeder
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
            $urlAyat = env('APP_QURAN_LATIN_URL') . "/surat/$surat->order";
            $requestAyat = Http::retry(3, 60000)->get($urlAyat);
            if ($requestAyat->successful()) {
                $responseAyat = (object) $requestAyat->json();
                foreach ($responseAyat as $k => $ayat) {
                    $dataAyat = (object) $ayat;
                    $textLatin = strip_tags($dataAyat->tr);
                    $this->ayat
                        ->where('surat_id', $surat->id)
                        ->where('order', $k + 1)
                        ->update(['text_latin' => $textLatin]);
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
