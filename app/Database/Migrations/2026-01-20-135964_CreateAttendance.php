<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttendance extends Migration
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
            'session' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'class' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'section' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'student' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true,
            ],
            'attendance' => [
                'type'       => "ENUM('Present', 'Absent', 'Late')",
                'null'       => true,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
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

        $this->forge->addForeignKey('class', 'class', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('section', 'section', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('session', 'session', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('student', 'student', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('trust_id', 'trust', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('school_id', 'school', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('student_attendance');
    }

    public function down()
    {
        $this->forge->dropTable('student_attendance');
    }
}
