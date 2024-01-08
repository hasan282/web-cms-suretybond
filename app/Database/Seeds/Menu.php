<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menu extends Seeder
{
    public function run()
    {
        $group = array(

            [100, 'Certificate', 'fas fa-certificate'],
            [200, 'Principal',   'fas fa-user-tie'],
            [300, 'Insurance',   'fas fa-shield-alt'],
            [400, 'Sub-Agent',   'fas fa-user-friends']

        );

        $menu = array(

            [101, 'Certificate List',   'fas fa-list-ul',     'certificate',      100],
            [102, 'Add New',            'fas fa-plus-circle', '#add-certificate', 100],
            [201, 'Principal List',     'fas fa-list-ul',     '#principal',       200],
            [202, 'Add New',            'fas fa-plus-circle', '#add-principal',   200],
            [301, 'Insurance List',     'fas fa-list-ul',     '#insurance',       300],
            [302, 'Add New',            'fas fa-plus-circle', '#add-insurance',   300],
            [401, 'Sub-Agent List',     'fas fa-list-ul',     '#subagent',        400],
            [402, 'Add New',            'fas fa-plus-circle', '#add-subagent',    400],
            [501, 'Blanko Monitoring',  'fas fa-layer-group', '#blanko',         null],
            [601, 'User Management',    'fas fa-user-cog',    '#user-manage',    null],
            [701, 'Report & Analytics', 'fas fa-chart-line',  '#report',         null]

        );

        $this->db->table('c_menu_group')->insertBatch(
            $this->setup([
                'id', 'text', 'icon'
            ], $group)
        );

        $this->db->table('c_menu')->insertBatch(
            $this->setup([
                'id', 'text', 'icon', 'url', 'id_group'
            ], $menu)
        );
    }

    private function setup(array $fields, array $data): array
    {
        $result = [];
        foreach ($data as $d) {
            $row = [];
            foreach ($d as $key => $val) {
                $row[$fields[$key]] = $val;
            }
            $result[] = $row;
        }
        return $result;
    }
}
