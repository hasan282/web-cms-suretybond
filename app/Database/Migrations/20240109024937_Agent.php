<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'     => [
                'type'       => 'VARCHAR',
                'constraint' => 16
            ],
            'hash'   => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'default'    => null
            ],
            'nama'   => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'nick'   => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
                'default'    => null
            ],
            'telpon' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'tipe'   => [
                'type'       => 'ENUM',
                'constraint' => ['HEAD', 'SUB'],
                'null'       => true,
                'default'    => null
            ],
            'active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0
            ]
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('hash', 'PARAM');
        $this->forge->addKey('active', false, false, 'ACTIVE');

        $this->forge->createTable('d_agent', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_agent', true);
    }
}
