<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSection extends Migration
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
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'student_capacity' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status' => [
                'type'       => "ENUM('Active','Inactive')",
                'default'    => 'Active',
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('trust_id', 'trust', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('class_id', 'class', 'id', 'SET NULL', 'CASCADE');

        $this->forge->addField("
		    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
		");

        $this->forge->createTable('section');
    }

    public function down()
    {
        $this->forge->dropTable('section');
    }
}
