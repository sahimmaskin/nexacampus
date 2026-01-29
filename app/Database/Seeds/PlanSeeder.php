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
            ],
        ];

        $this->db->table('plan')->insertBatch($data);
    }
}
