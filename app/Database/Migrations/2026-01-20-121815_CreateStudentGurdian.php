<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentGurdian extends Migration
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
                'null'       => true,
                'unique'     => true,
            ],
            'f_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'm_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'     => true,
            ],
            'f_mobile' => [
                'type'       => "VARCHAR",
                'constraint' => 10,
                'null'       => true,
            ],
            'm_mobile' => [
                'type'       => "VARCHAR",
                'constraint' => 10,
                'null'       => true,
            ],
            'f_occupation' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'm_occupation' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'f_income' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'm_income' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
        ]);

        $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
        ");

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('student_id', 'student', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('student_gurdian');
    }

    public function down()
    {
        $this->forge->dropTable('student_gurdian');
    }
}
