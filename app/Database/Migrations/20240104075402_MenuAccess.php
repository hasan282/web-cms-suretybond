<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuAccess extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'id_access' => [
                'type'           => 'INT',
                'constraint'     => 3,
                'null'           => true,
                'default'        => null,
                'unsigned'       => true
            ],
            'id_menu'   => [
                'type'           => 'INT',
                'constraint'     => 3,
                'null'           => true,
                'default'        => null,
                'unsigned'       => true
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addKey('id_access', false, false, 'ACCESS');
        $this->forge->addKey('id_menu', false, false, 'MENU');

        $this->forge->addForeignKey('id_access', 'c_access', 'id', 'CASCADE', 'CASCADE', 'ACCESSID');
        $this->forge->addForeignKey('id_menu', 'c_menu', 'id', 'CASCADE', 'CASCADE', 'MENUID');

        $this->forge->createTable('c_menu_access', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('c_menu_access', true);
    }
}
