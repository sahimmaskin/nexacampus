<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocumentType extends Migration
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
            'doc_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'doc_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'no_reqd' => [
                'type'       => "ENUM('Yes', 'No')",
                'null'       => true,
            ],
            'file_front_reqd' => [
                'type'       => "ENUM('Yes', 'No')",
                'null'       => true,
            ],
            'file_back_reqd' => [
                'type'       => "ENUM('Yes', 'No')",
                'null'       => true,
            ],
            'status' => [
                'type'       => "ENUM('Active', 'Inactive')",
                'default'       => 'Active',
            ],
            'doc_char' => [
                'type'       => "VARCHAR",
                'constraint' => 100,
                'null'       => true,
            ],
            'doc_size' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'file_type' => [
                'type'       => "VARCHAR",
                'constraint' => 100,
                'null'       => true,
            ],
            'height' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'width' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'is_required' => [
                'type'       => "ENUM('Yes', 'no')",
                'null'       => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('doc_type', true);
    }

    public function down()
    {
        $this->forge->dropTable('doc_type', true);
    }
}
