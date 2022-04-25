<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class incharge_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for ($i=1; $i < 12; $i++) {
            $data[$i] = [
                'name' => 'Incharge'.$i,
                'email' => 'incharge'.$i.'@gmail.com',
                'password' => Hash::make('incharge'.$i.'@123'),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
        }
        DB::table('incharge')->insert($data);
    }
}
