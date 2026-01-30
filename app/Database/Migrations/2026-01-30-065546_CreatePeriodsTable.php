<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeriodsTable extends Migration
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
            'school_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'start_time' => [
                'type' => 'TIME',
            ],
            'end_time' => [
                'type' => 'TIME',
            ]
           
        ]);
        $this->forge->addField("
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            deleted_at DATETIME NULL
             ");

        $this->forge->addKey('id', true);

        // Foreign key
        $this->forge->addForeignKey(
            'school_id',
            'school',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('periods');
    }

    public function down()
    {
        $this->forge->dropTable('periods');
    }
}
