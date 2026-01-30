<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlan extends Migration
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
            'duration' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'amount' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'school' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'status' => [
                'type' => "ENUM('Active', 'Inactive')",
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('plan', true);
    }

    public function down()
    {
        $this->forge->dropTable('plan', true);
    }
}
