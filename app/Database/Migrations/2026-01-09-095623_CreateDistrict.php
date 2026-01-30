<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDistrict extends Migration
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
            'district' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true
            ],
            'state_id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'null'  => false,
            ],
            'states_name' => [
                'type'           => 'TEXT',
                'null'           => false
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

        $this->forge->addForeignKey('state_id', 'loc_state', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('loc_district', true);
    }

    public function down()
    {
        $this->forge->dropTable('loc_district', true);
    }
}
