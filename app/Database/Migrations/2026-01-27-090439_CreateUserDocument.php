<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserDocument extends Migration
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
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'doc_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'user_type' => [
                'type' => "ENUM('Student', 'Teacher')",
                'null'       => true,
            ],
            'doc_no' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'doc_front' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'doc_back' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status' => [
                'type' => "ENUM('Pending','Approved','Rejected','Incomplete')",
                'null' => true,
            ],
            'remarks' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('student_id', 'student', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('doc_id', 'doc_type', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_docs', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_docs', true);
    }
}
