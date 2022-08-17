<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class SlugSeeder extends Seeder
{
    protected $surat;

    public function __construct()
    {
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
        foreach ($surats as $i => $surat) {
            $lower = Str::lower((string) $surat->name);
            $slug = str_replace("'", '', str_replace(' ', '-', $lower));
            $surat->update(['slug' => $slug]);
            (new ConsoleOutput())->writeln("Result : $slug");
            $count++;
        }
        (new ConsoleOutput())->writeln("Result $count slug : success");
    }
}
