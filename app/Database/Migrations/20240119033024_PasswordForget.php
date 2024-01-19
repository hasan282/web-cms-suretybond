<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasswordForget extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'id_user' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'default' => null
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '34',
                'default' => null
            ],
            'changed' => [
                'type' => 'DATETIME',
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addKey('id_user', false, false, 'USER');

        $this->forge->addForeignKey('id_user', 'd_user', 'id', 'CASCADE', 'IDUSER');

        $this->forge->createTable('h_password_forget', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('h_password_forget', true);
    }
}
