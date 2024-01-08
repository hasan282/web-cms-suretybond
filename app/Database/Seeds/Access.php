<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Access extends Seeder
{
    public function run()
    {
        $access = array(

            ['id' => 101, 'access' => 'Administrator'],
            ['id' => 201, 'access' => 'Head Manager'],
            ['id' => 202, 'access' => 'Head User'],
            ['id' => 203, 'access' => 'Head Management'],
            ['id' => 301, 'access' => 'Sub-Agent User'],
            ['id' => 302, 'access' => 'Sub-Agent Management']

        );
        $this->db->table('c_access')->insertBatch($access);
    }
}
