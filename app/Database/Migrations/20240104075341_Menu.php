<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
            ],
            'url'      => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'id_group' => [
                'type'       => 'INT',
                'constraint' => 3,
                'null'       => true,
                'default'    => null,
                'unsigned'   => true
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('url', 'LINK');
        $this->forge->addKey('id_group', false, false, 'GROUP');

        $this->forge->addForeignKey('id_group', 'c_menu_group', 'id', 'CASCADE', 'SET NULL', 'GROUPID');

        $this->forge->createTable('c_menu', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('c_menu', true);
    }
}
