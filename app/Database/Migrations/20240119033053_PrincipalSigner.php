<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrincipalSigner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '16'
            ],
            'hash' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'default' => null
            ],
            'id_principal' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
                'default' => null
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'default' => null
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'default' => null
            ],
            'active' => [
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => null
            ],
        ]);
        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addKey('active', false, false, 'ACTIVE');
        $this->forge->addKey('id_principal', false, false, 'PRINCIPAL');

        $this->forge->addForeignKey('id_principal', 'd_principal', 'id', 'CASCADE', 'IDPRINCIPAL');

        $this->forge->addUniqueKey('hash', 'PARAM');

        $this->forge->createTable('d_principal_signer', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_principal_signer', true);
    }
}
