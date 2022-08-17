<?php

namespace Database\Seeders;

use App\Helpers\GlobalHelper;
use App\Models\Ayat;
use App\Models\File;
use App\Models\Surat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class FileSeeder extends Seeder
{
    protected $ayat;
    protected $surat;
    protected $file;

    public function __construct()
    {
        $this->ayat = new Ayat();
        $this->surat = new Surat();
        $this->file = new File();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        $countSuccess = 0;
        $countFailed = 0;
        $ayats = $this->ayat->doesntHave('file')->get();
        if (count($ayats)) {
            foreach ($ayats as $ayat) {
                $keySuratId = str_pad($ayat->surat->order, 3, '0', STR_PAD_LEFT);
                $keyAyatId = str_pad($ayat->order, 3, '0', STR_PAD_LEFT);
                $urlMP3 = env('APP_QURAN_URL') . "/cmsq/source/s01/$keySuratId" . $keyAyatId . ".mp3";
                $checkContent = file_get_contents($urlMP3);
                $fileId = Str::uuid();

                if ($checkContent) {
                    $fileMP3 = (new GlobalHelper)->downloadFile($urlMP3, $fileId);
                    $this->file->create([
                        'id' => $fileId,
                        'fileable_id' => $ayat->id,
                        'fileable_type' => Ayat::class,
                        'file_path' => $fileMP3->file_path,
                        'file_name' => $fileMP3->file_name,
                        'file_mime' => $fileMP3->file_mime,
                        'source' => 'Kemenag',
                    ]);
                    $countSuccess++;
                } else {
                    $countFailed++;
                }
                (new ConsoleOutput())->writeln("$ayat->order. Surat " . $ayat->surat->name . " Ayat $ayat->id = " . ($fileMP3->file_name ?? 'No File Upload'));
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
