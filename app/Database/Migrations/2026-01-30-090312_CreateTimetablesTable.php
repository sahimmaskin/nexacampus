<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTimetablesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
             'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'school_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'null'      =>true,
        ],
        'class_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'null'     =>true,
        ],
           'section_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'null'     =>true,
        ],
           'period_id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'null'     =>true,
        ],
          'day' => [
            'type' => 'ENUM',
            'constraint' => ['mon','tue','wed','thu','fri','sat'],
            'null'      =>true, 
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('timetables');
    }

    public function down()
    {
        $this->forge->dropTable('timetables');
    }
}
