<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailVerify extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'       => 'VARCHAR',
                'constraint' => 16
            ],
            'id_user'     => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'otp'         => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
                'null'       => true,
                'default'    => null
            ],
            'verified'    => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addKey('id_user', false, false, 'USER');

        $this->forge->addForeignKey('id_user', 'd_user', 'id', 'CASCADE', 'CASCADE', 'VERIFYUSER');

        $this->forge->createTable('h_email_verify', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('h_email_verify', true);
    }
}
