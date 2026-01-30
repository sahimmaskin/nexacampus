<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'              => 'Admin',
            ],
            [
                'name'              => 'Teaching',
            ],
            [
                'name'              => 'Accounts',
            ],
            [
                'name'              => 'Library',
            ],
            [
                'name'              => 'Transport',
            ],
        ];
        $this->db->table('department')->insertBatch($data);
    }
}
