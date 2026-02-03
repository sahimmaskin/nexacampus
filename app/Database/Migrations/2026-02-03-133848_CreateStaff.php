<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaff extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'school_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null'      => true,
            ],
            'designation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null'      => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'     => true,
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null'     => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'     => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive'],
                'default'  => 'Active'
            ]
        ]);
        $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
        ");
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('designation_id', 'designation', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('staff');
    }

    public function down()
    {
        $this->forge->dropTable('staff');
    }
}
