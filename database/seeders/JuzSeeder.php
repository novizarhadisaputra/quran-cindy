<?php

namespace Database\Seeders;

use App\Models\Ayat;
use App\Models\Juz;
use App\Models\Surat;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class JuzSeeder extends Seeder
{
    protected $ayat;
    protected $surat;
    protected $juz;

    public function __construct()
    {
        $this->ayat = new Ayat();
        $this->surat = new Surat();
        $this->juz = new Juz();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $urlJuz = env('APP_QURAN_JUZ_URL') . "/api/v3/juzs";
            $requestJuz = Http::retry(3, 60000)->get($urlJuz);
            $countSuccess = 0;
            $countFailed = 0;
            if ($requestJuz->successful()) {
                $responseJuz = (object) $requestJuz->json();
                $responseDataJuz = $responseJuz->juzs;
                foreach ($responseDataJuz as $i => $juz) {
                    $dataJuz = (object) $juz;
                    $juzId = Str::uuid();

                    $this->juz->create([
                        'id' => $juzId,
                        'order' => $i + 1,
                        'count' => $dataJuz->verses_count,
                    ]);
                }
                $countSuccess++;
                (new ConsoleOutput())->writeln($urlJuz . " : success");
                (new ConsoleOutput())->writeln("");
            } else {
                $countFailed++;
                (new ConsoleOutput())->writeln($urlJuz . " : failed");
                (new ConsoleOutput())->writeln("");
            }

            $juzes = $this->juz->all();
            $lastSurat = null;
            $lastAyat = null;
            foreach ($juzes as $juz) {
                $surats = $this->surat->orderBy('order', 'asc')->get();
                if ($lastSurat) {
                    $surat = $this->surat->find($lastSurat);
                    $surats = $this->surat->where('order', '>=', $surat->order)->orderBy('order', 'asc')->get();
                }
                $count = 0;
                foreach ($surats as $surat) {
                    $ayats = $this->ayat->where('surat_id', $surat->id)->orderBy('order', 'asc')->get();
                    if ($lastSurat) {
                        $ayats = $this->ayat
                            ->where('surat_id', $surat->id)
                            ->where('order', '>', $lastAyat)->orderBy('order', 'asc')->get();
                        $lastSurat = null;
                        $lastAyat = null;
                    }
                    foreach ($ayats as $ayat) {
                        $ayat->update(['juz_id' => $juz->id]);
                        $count++;

                        if ($juz->count == $count) {
                            $lastSurat = $ayat->surat->id;
                            $lastAyat = $ayat->order;
                            (new ConsoleOutput())->writeln("Last Surat : " . $ayat->surat->name);
                            (new ConsoleOutput())->writeln("Last Ayat  : " . $lastAyat);
                            (new ConsoleOutput())->writeln("Count " . $count . " : success");
                            (new ConsoleOutput())->writeln("Juz " . $juz->order . " : success");
                            (new ConsoleOutput())->writeln("=====================================");
                            break;
                        }
                    }
                    if ($juz->count == $count) {
                        $count = 0;
                        break;
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            (new ConsoleOutput())->writeln("Error : " . $e->getMessage());
        }
    }
}
