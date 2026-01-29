<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubject extends Migration
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
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 70,
                'null'       => true,
            ],
            'code' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'type' => [
                'type'       => "ENUM('General', 'Routine')",
                'null'    => true,
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
        ]);

        $this->forge->addField("
		    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
		");

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('trust_id', 'trust', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('subject');
    }

    public function down()
    {
        $this->forge->dropTable('subject');
    }
}
