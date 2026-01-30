<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DesignationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'school_id' => null,
                'department_id'     => '1',
                'name' => 'Principal',
            ],
            [
                'school_id' => null,
                'department_id'     => '2',
                'name' => 'Faculty',
            ],
            [
                'school_id' => null,
                'department_id'     => '3',
                'name' => 'Accountant',
            ],
        ];
        $this->db->table('designation')->insertBatch($data);
    }
}
