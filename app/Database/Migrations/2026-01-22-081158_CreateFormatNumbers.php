<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormatNumbers extends Migration
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
            'format_type' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'format_prefix' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'format_number' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
            ],
            'format_suffix' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'       => true,
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

        $this->forge->addForeignKey('format_type', 'format_type', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('trust_id', 'trust', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('format_numbers');
    }

    public function down()
    {
        $this->forge->dropTable('format_numbers');
    }
}
