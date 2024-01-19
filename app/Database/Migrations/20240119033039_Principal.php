<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Principal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'hash' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'default' => null,
            ],
            'principal' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'default' => null
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'default' => null
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'default' => null
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'default' => null
            ],
            'id_agent' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
                'default' => null
            ],
            'active' => [
                'type' => 'TINYINT',
                'constraint' => '1'
            ]
        ]);
        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addKey('active', false, false, 'ACTIVE');
        $this->forge->addKey('id_agent', false, false, 'AGENT');

        $this->forge->addForeignKey('id_agent', 'd_agent', 'id', 'CASCADE', 'USERAGENT');

        $this->forge->addUniqueKey('hash', 'PARAM');

        $this->forge->createTable('d_principal', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_principal', true);
    }
}
