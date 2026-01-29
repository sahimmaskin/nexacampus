<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentDocuments extends Migration
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
            'appl_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'unique'     => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'unique'     => true,
            ],
            'gender' => [
                'type' => "ENUM('Male','Female','Other')",
                'null' => true,
            ],
            'dob' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'blood_group' => [
                'type' => "ENUM('A+','A-','B+','B-','AB+','AB-','O+','O-')",
                'null' => true,
            ],
            'religion' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'nationality' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'section_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'session_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'trust_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'school_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'status' => [
                'type'    => "ENUM('Active','Inactive')",
                'default' => 'Active',
            ],
        ]);

        $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
        ");

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('class_id',   'class',   'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('section_id', 'section', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('session_id', 'session', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('trust_id',   'trust',   'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id',  'school',  'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('student', true);
    }

    public function down()
    {
        $this->forge->dropTable('student', true);
    }
}
