<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Access extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'     => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true
            ],
            'access' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');

        $this->forge->createTable('c_access', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('c_access', true);
    }
}
