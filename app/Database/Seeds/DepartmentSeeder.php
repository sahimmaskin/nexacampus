<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [            	
                'name'  			=> 'Principal',
            ],
            [            	
                'name'  			=> 'Faculties',
            ],
            [            	
                'name'  			=> 'Accountant',
            ],
            [            	
                'name'  			=> 'Librarian',
            ],
            [            	
                'name'  			=> 'Transport',
            ],
            [            	
                'name'  			=> 'Students',
            ],
        ];

        $this->db->table('department')->insertBatch($data);
    }
}
