<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PrincipalSigner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => [
                'type'       => 'VARCHAR',
                'constraint' => 16
            ],
            'hash'         => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'default'    => null
            ],
            'id_principal' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
                'null'       => true,
                'default'    => null
            ],
            'nama'         => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'position'     => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
                'default'    => null
            ],
            'active'       => [
                'type'       => 'TINYINT',
                'unsigned'   => true,
                'constraint' => 1,
                'default'    => 0
            ],
        ]);

        $this->forge->addPrimaryKey('id', 'PRIMARY');
        $this->forge->addUniqueKey('hash', 'PARAM');
        $this->forge->addKey('id_principal', false, false, 'PRINCIPAL');
        $this->forge->addKey('active', false, false, 'ACTIVE');

        $this->forge->addForeignKey('id_principal', 'd_principal', 'id', 'CASCADE', 'SET NULL', 'SIGNERPRINCIPAL');

        $this->forge->createTable('d_principal_signer', true, [
            'ENGINE' => 'InnoDB'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('d_principal_signer', true);
    }
}
