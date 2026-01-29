<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormatTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [            	
                'name'  			=> 'Application Number',
            ],
            [            	
                'name'  			=> 'Registration Number',
            ],
        ];

        $this->db->table('format_type')->insertBatch($data);
    }
}
