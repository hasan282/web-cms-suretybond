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
            'verify'    => 'id_verify',
            'pass'      => 'password',
            'nama'      => 'nama',
            'image'     => 'image',
            'access_id' => 'id_access',
            'agent_id'  => 'id_agent',
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
        $this->fields('h_email_verify', [
            'verify_user' => 'id_user',
            'otp'         => 'otp',
            'verify_at'   => 'verified',
        ]);
        $this->join('d_user.id_agent=d_agent.id', 'left');
        $this->join('d_user.id_verify=h_email_verify.id', 'left');
        return parent::select($fields);
    }

    public function where($where)
    {
        $this->alias('where', [
            'id'     => 'd_user.id',
            'hash'   => 'd_user.hash',
            'user'   => 'd_user.username',
            'email'  => 'd_user.email',
            'active' => 'd_user.active'
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

        ])->where(['active' => 1])->compile();
        $query .= ' AND (`d_user`.`username` = ? OR `d_user`.`email` = ?)';
        $userdata = $this->query($query, [$user, $user])->getResultArray();

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

    public function editEmail(string $email, ?string $id)
    {
        if ($id === null) return false;
        $this->connect->transBegin();
        $this->connect->table('d_user')->update(
            array('email' => $email, 'id_verify' => null),
            array('id' => $id)
        );
        $this->connect->transComplete();
        return $this->connect->transStatus();
    }
}
