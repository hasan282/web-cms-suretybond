<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'       => 'VARCHAR',
                'constraint' => 16
            ],
            'hash'        => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'default'    => null
            ],
            'username'    => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
                'default'    => null
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'id_verify'       => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'password'    => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'default'    => null
            ],
            'nama'        => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'id_access'   => [
                'type'       => 'INT',
                'constraint' => 3,
                'unsigned'   => true,
                'default'    => null
            ],
            'id_agent'    => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'active'      => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('hash', 'PARAM');
        $this->forge->addUniqueKey('username', 'USER');
        $this->forge->addUniqueKey('email', 'EMAIL');
        $this->forge->addKey('id_access', false, false, 'ACCESS');
        $this->forge->addKey('id_agent', false, false, 'AGENT');
        $this->forge->addKey('active', false, false, 'ACTIVE');

        $this->forge->addForeignKey('id_access', 'c_access', 'id', 'CASCADE', 'SET NULL', 'USERACCESS');
        $this->forge->addForeignKey('id_agent', 'd_agent', 'id', 'CASCADE', 'SET NULL', 'USERAGENT');

        $this->forge->createTable('d_user', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_user', true);
    }
}
