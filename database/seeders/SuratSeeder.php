<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Support\Str;
use App\Models\SuratCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;

class SuratSeeder extends Seeder
{
    protected $surat;
    protected $category;

    public function __construct()
    {
        $this->surat = new Surat();
        $this->category = new SuratCategory();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makkahId = ($this->category->where('name', 'Makkah')->first())->id;
        $madinahId = ($this->category->where('name', 'Madinah')->first())->id;
        $url = env('APP_QURAN_URL') . '/api/v1/surah/0/114';
        $count = 0;
        $request = Http::get($url);
        if ($request->successful()) {
            $response = (object) $request->json();
            $responseDataSurat = $response->data;
            foreach ($responseDataSurat as $i => $surat) {
                $dataSurat = (object) $surat;
                $suratId = Str::uuid();
                $this->surat->create([
                    'id' => $suratId,
                    'order' => $i + 1,
                    'name' => $dataSurat->surat_name,
                    'slug' => Str::slug($dataSurat->surat_name),
                    'text' => $dataSurat->surat_text,
                    'text_translate' => $dataSurat->surat_terjemahan,
                    'surat_category_id' => $dataSurat->golongan_surah == 'مكية' ? $makkahId : $madinahId,
                ]);
                $count++;
                (new ConsoleOutput())->writeln("Surat $dataSurat->surat_name : success");
            }
            (new ConsoleOutput())->writeln("");
            (new ConsoleOutput())->writeln("Total Surat : $count");
            (new ConsoleOutput())->writeln("==============================================");
            (new ConsoleOutput())->writeln("");
        }
    }
}
