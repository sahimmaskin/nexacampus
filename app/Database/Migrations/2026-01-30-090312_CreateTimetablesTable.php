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
        ]
        ]);
           $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
        ");
        $this->forge->addKey('id',true);
        $this->forge->createTable('timetables');
    }

    public function down()
    {
        $this->forge->dropTable('timetables');
    }
}
