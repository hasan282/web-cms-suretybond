<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuAccess extends Seeder
{
    public function run()
    {
        $roles = array(

            101 => [101, 102, 201, 202, 301, 302, 401, 402, 501, 601, 701], // Administrator
            201 => [101, 102, 201, 202, 301, 302, 401, 402, 501, 601, 701], // Head Manager
            202 => [101, 102, 201, 202, 301, 'x', 401, 'x', 501, 'x', 701], // Head User
            203 => [101, 'x', 201, 'x', 301, 'x', 401, 'x', 501, 'x', 701], // Head Management
            301 => [101, 102, 201, 202, 301, 'x', 'x', 'x', 501, 'x', 701], // Sub-Agent User
            302 => [101, 'x', 201, 'x', 301, 'x', 'x', 'x', 501, 'x', 701]  // Sub-Agent Management

        );
        $this->db->table('c_menu_access')->insertBatch(
            $this->setup($roles)
        );
    }

    private function setup(array $data): array
    {
        $access = [];
        foreach ($data as $key => $value) {
            foreach ($value as $val) {
                if ($val != 'x' && is_int($val)) {
                    $access[] = array(
                        'id_access' => $key,
                        'id_menu'   => $val
                    );
                }
            }
        }
        return $access;
    }
}
