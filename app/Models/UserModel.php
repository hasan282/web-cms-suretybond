<?php

namespace App\Models;

use App\Models\Core\BaseModel;

class UserModel extends BaseModel
{
    public function select(array $fields = [])
    {
        $this->fields('d_user', [
            'id'        => 'id',
            'hash'      => 'hash',
            'user'      => 'username',
            'email'     => 'email',
            'pass'      => 'password',
            'nama'      => 'nama',
            'image'     => 'image',
            'access_id' => 'id_access',
            'agent_id'  => 'id_agent',
            'valid'     => 'email_valid',
            'active'    => 'active'
        ]);
        $this->fields('d_agent', [
            'hash_agent'   => 'hash',
            'agent'        => 'nama',
            'nick'         => 'nick',
            'alamat'       => 'alamat',
            'telpon'       => 'telpon',
            'tipe'         => 'tipe',
            'active_agent' => 'active'
        ]);
        $this->join('d_user.id_agent=d_agent.id', 'left');
        return parent::select($fields);
    }

    public function where($where)
    {
        $this->alias('where', [
            'hash'  => 'd_user.hash',
            'user'  => 'd_user.username',
            'email' => 'd_user.email'
        ]);
        return parent::where($where);
    }

    public function login(?string $user, ?string $pass): array
    {
        $result = ['status' => false, 'data' => null];
        if ($user === null || $pass === null) return $result;

        $query = $this->select([

            'id', 'hash', 'user', 'email', 'pass', 'nama',
            'image', 'access_id', 'agent_id', 'agent'

        ])->where(['user' => $user])->compile();
        $query .= ' OR `d_user`.`email` = ?';
        $userdata = $this->query($query, [$user])->getResultArray();

        if (sizeof($userdata) === 1) {
            $result['data'] = $userdata[0];
            if ($userdata[0]['pass'] === sha3hash($pass, 50)) {
                $result['status'] = true;
            }
            return $result;
        } else {
            $result['data'] = [];
            return $result;
        }
    }
}
