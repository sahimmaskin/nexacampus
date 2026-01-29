<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployee extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'email' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mobile' => [
                'type'       => 'BIGINT',
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
            'user_type' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'accn_status' => [
                'type'       => "ENUM('Pending','Approved', 'Rejected')",
                'default'    => 'Approved',
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

        $this->forge->addForeignKey('trust_id', 'trust', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('user_type', 'department', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
