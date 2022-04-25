<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class department_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $department = ['sales Department', 'Project Department', 'Designing Department', 'Production Department', 'Maintenance Department', 'Store Department', 'Procurement Department', 'Quality Department', 'Inspection department', 'Packaging Department', 'Finance Department', 'Dispatch Department', 'Account Department', 'Research & Development Department', 'Information Technology Department', 'Human Resource Department', 'Security Department', 'Administration department'];
        for ($i = 0; $i < 18; $i++) {
            $data[$i] = [
                'department' => $department[$i],
                'inchargeID' => rand(1,12),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];
        }
        DB::table('departments')->insert($data);
    }
}
