<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDepartment extends Migration
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
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
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

        $this->forge->createTable('department');
    }

    public function down()
    {
        $this->forge->dropTable('department');
    }
}
