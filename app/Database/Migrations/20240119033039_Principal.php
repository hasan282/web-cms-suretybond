<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Principal extends Migration
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
            'principal'   => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => true,
                'default'    => null
            ],
            'address'     => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => true,
                'default'    => null
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
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
                'unsigned'   => true,
                'constraint' => 1,
                'default'    => 0
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('hash', 'PARAM');
        $this->forge->addKey('id_agent', false, false, 'AGENT');
        $this->forge->addKey('active', false, false, 'ACTIVE');

        $this->forge->addForeignKey('id_agent', 'd_agent', 'id', 'CASCADE', 'SET NULL', 'PRINCIPALAGENT');

        $this->forge->createTable('d_principal', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_principal', true);
    }
}
