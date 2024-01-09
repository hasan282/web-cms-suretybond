<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $user = array(

            [
                'username' => 'administrator',
                'email'    => 'pt.jasmine.is@gmail.com',
                'nama'     => 'Administrator',
                'image'    => 'M',
                'access'   => 101,
                'agent'    => 'JIS'
            ],
            [
                'username' => 'jabidin',
                'email'    => 'm.jabidin@ptjis.id',
                'nama'     => 'Muhammad Jabidin',
                'image'    => 'M',
                'access'   => 201,
                'agent'    => 'JIS'
            ],
            [
                'username' => 'yolanda',
                'email'    => 'yolanda.putri@ptjis.id',
                'nama'     => 'Yolanda Putri',
                'image'    => 'F',
                'access'   => 202,
                'agent'    => 'JIS'
            ]

        );
        $this->db->table('d_user')->insertBatch(
            $this->setup($user)
        );
    }

    private function setup($data): array
    {
        $agent = $this->agent();
        $user  = [];
        helper(['format', 'hash']);
        foreach ($data as $dat) {

            $row['id']          = create_id(4, true);
            $row['hash']        = 'us' . myhash($row['id'], 28, true);
            $row['username']    = $dat['username'];
            $row['email']       = $dat['email'];
            $row['password']    = sha3hash('jasmine', 50);
            $row['nama']        = $dat['nama'];
            $row['image']       = 'default/USER000' . $dat['image'] . '.jpg';
            $row['id_access']   = $dat['access'];
            $row['id_agent']    = array_key_exists(
                $dat['agent'],
                $agent
            ) ? $agent[$dat['agent']] : null;
            $row['email_valid'] = 0;
            $row['active']      = 1;

            $user[] = $row;
        }
        return $user;
    }

    private function agent(): array
    {
        $model  = new \App\Models\AgentModel;
        $agent  = $model->select(['id', 'nick'])->data();
        $result = [];
        foreach ($agent as $agt) {
            $result[$agt['nick']] = $agt['id'];
        }
        return $result;
    }
}
