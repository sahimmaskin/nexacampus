<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'duration' => 12,
                'name'     => 'Session',
                'amount' => 5000,
                'description' => NULL,
                'school' => 2,
                'status' => 'Active'
            ],
        ];

        $this->db->table('plan')->insertBatch($data);
    }
}
