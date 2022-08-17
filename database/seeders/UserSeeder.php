<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected $user;
    protected $userDetail;

    public function __construct()
    {
        $this->user = new User();
        $this->userDetail = new UserDetail();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = Str::uuid();
        $userDetailId = Str::uuid();

        $this->user->create([
            'id' => $userId,
            'name' => 'Developer QuranApp',
            'email' => 'novizarhadisaputra@gmail.com',
            'password' => Hash::make('Ca210399'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $this->userDetail->create([
            'id' => $userDetailId,
            'phone' => '085888426559',
            'status' => 'Married',
            'address' => 'Jl. Mampang Prapatan',
            'born_date' => date('Y-m-d H:i:s', strtotime("3 November 1995")),
            'job' => 'Programmer',
            'sex' => 1,
            'user_id' => $userId,
        ]);
    }
}
