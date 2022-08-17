<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\SuratCategory;
use Illuminate\Database\Seeder;

class SuratCategorySeeder extends Seeder
{
    protected $category;

    public function __construct()
    {
        $this->category = new SuratCategory();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->category->create([
            'id' => Str::uuid(),
            'name' => 'Makkah'
        ]);

        $this->category->create([
            'id' => Str::uuid(),
            'name' => 'Madinah'
        ]);
    }
}
