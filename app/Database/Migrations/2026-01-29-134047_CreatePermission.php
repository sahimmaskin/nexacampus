<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermission extends Migration
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
            'module' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'action' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
        ]);

        $this->forge->addField("
		    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
		");

        $this->forge->addKey('id', true);

        $this->forge->createTable('permission');
    }

    public function down()
    {
        $this->forge->dropTable('permission');
    }
}
