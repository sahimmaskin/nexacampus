<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'doc_order'         => null,
                'doc_name'          => 'Passport Size Photo',
                'no_reqd'           => 'No',
                'file_front_reqd'   => 'Yes',
                'file_back_reqd'    => 'No',
                'status'            => 'Active',
                'doc_char'          => null,
                'doc_size'          => 2048,
                'file_type'         => '*/image',
                'height'            => 265,
                'width'             => 325,
                'is_required'       => 'Yes',
            ],[
                'doc_order'         => null,
                'doc_name'          => 'Aadhaar Card',
                'no_reqd'           => 'Yes',
                'file_front_reqd'   => 'Yes',
                'file_back_reqd'    => 'Yes',
                'status'            => 'Active',
                'doc_char'          => '[0-9]{12}',
                'doc_size'          => 2048,
                'file_type'         => '*/image',
                'height'            => null,
                'width'             => null,
                'is_required'       => 'Yes',
            ]
        ];

        $this->db->table('doc_type')->insertBatch($data);
    }
}
