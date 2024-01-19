<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'  => 'INT',
                'constraint' => '15'
            ],
            'email'    => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'id_user'    => [
                'type'  => 'INT',
                'constraint' => '15'
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'default' => 'null'
            ],
            'created_at timestamp default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->createTable('d_token', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_token', true);
    }
}
