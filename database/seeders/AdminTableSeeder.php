<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password=Hash::make('123');
        $adminRecords=['name'=>'Admin','image'=>'','email'=>'admin@admin.com','type'=>'admin','mobile'=>'0772468070','status'=>1,'password'=>$password];

        Admin::insert($adminRecords);
    }
}
