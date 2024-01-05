<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuGroup extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true
            ],
            'text'     => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
                'default'    => null
            ],
            'icon'     => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');

        $this->forge->createTable('c_menu_group', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('c_menu_group', true);
    }
}
