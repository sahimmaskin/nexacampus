<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTimeTableSlotTable extends Migration
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

        'staff_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'      =>true,
        ],

        'timetable_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'      =>true,

        ],

        'period_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'      =>true,

        ],

        'subject_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'      =>true,

        ],

        'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        'deleted_at DATETIME NULL',
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addUniqueKey(['timetable_id', 'period_id']);
    $this->forge->addForeignKey('timetable_id', 'timetables', 'id', 'SET NULL', 'CASCADE');
    $this->forge->addForeignKey('period_id', 'periods', 'id', 'SET NULL', 'CASCADE');
    $this->forge->addForeignKey('subject_id', 'subject', 'id', 'SET NULL', 'CASCADE');
    $this->forge->addForeignKey('staff_id', 'staff', 'id', 'SET NULL', 'CASCADE');

    $this->forge->createTable('timetable_slots');
}


    public function down()
    {
        $this->forge->dropTable('timetable_slots');

    }
}
