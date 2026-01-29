<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentPreviousDetails extends Migration
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
            'prev_school_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'prev_class' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
                'null'       => true,
            ],
            'prev_board' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'prev_passing_year' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('student_id', 'student', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('student_prev_det', true);
    }

    public function down()
    {
        $this->forge->dropTable('student_prev_det', true);
    }
}
