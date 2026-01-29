<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormatType extends Migration
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
                'constraint'     => 100,
                'null'       => true,
            ],
            'status' => [
                'type'    => "ENUM('Active','Inactive')",
                'default' => 'Active',
                'null'    => false,
            ],
        ]);

        $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
        ");

        $this->forge->addKey('id', true);

        $this->forge->createTable('format_type');
    }

    public function down()
    {
        $this->forge->dropTable('format_type');
    }
}
