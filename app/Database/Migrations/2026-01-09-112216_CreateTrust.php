<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrust extends Migration
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
            'trust_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'email' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_1' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address_2' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'accn_status' => [
                'type'       => "ENUM('Pending','Approved', 'Rejected')",
                'default'    => 'Pending',
            ],
            'status' => [
                'type'       => "ENUM('Active','Inactive')",
                'default'    => 'Active',
            ],
        ]);

        $this->forge->addField("
		    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
		");

        $this->forge->addKey('id', true);

        $this->forge->createTable('trust');
    }

    public function down()
    {
        $this->forge->dropTable('trust');
    }
}
