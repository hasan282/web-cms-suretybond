<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasswordForgot extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
            ],
            'id_user'     => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'token'       => [
                'type'       => 'VARCHAR',
                'constraint' => 35,
                'null'       => true,
                'default'    => null
            ],
            'changed'     => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('token', 'TOKEN');
        $this->forge->addKey('id_user', false, false, 'USER');

        $this->forge->addForeignKey('id_user', 'd_user', 'id', 'CASCADE', 'SET NULL', 'PASSFORGOTUSER');

        $this->forge->createTable('h_password_forgot', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('h_password_forgot', true);
    }
}
