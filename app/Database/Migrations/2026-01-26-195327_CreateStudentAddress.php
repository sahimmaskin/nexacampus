<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentAddress extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],

            'present_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'present_state' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],
            'present_district' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],
            'present_city' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'present_po' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'present_ps' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'present_pincode' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
            ],

            'permanent_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'permanent_state' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],
            'permanent_district' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
            ],
            'permanent_city' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'permanent_po' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'permanent_ps' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'permanent_pincode' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('student_id', 'student', 'id', 'CASCADE', 'CASCADE');

        $this->forge->addForeignKey('present_state',   'loc_state',    'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('present_district', 'loc_district', 'id', 'SET NULL', 'CASCADE');

        $this->forge->addForeignKey('permanent_state',   'loc_state',    'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('permanent_district', 'loc_district', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('student_address', true);
    }

    public function down()
    {
        $this->forge->dropTable('student_address', true);
    }
}
