<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i=1; $i < 20; $i++) {
            $data[$i] = [
                'name' => 'user'.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => Hash::make('user'.$i.'@123'),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
        }
        DB::table('user')->insert($data);
    }
}
