<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateState extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'state' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true
            ],
            'status' => [
                'type'           => "ENUM('Active', 'Inactive')",
                'null'           => true
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('loc_state', true);
    }

    public function down()
    {
        $this->forge->dropTable('loc_state', true);
    }
}
