<?php

namespace App\Models;

use App\Models\Core\BaseModel;

class AgentModel extends BaseModel
{
    public function select(array $fields = [])
    {
        $this->fields('d_agent', [
            'id'     => 'id',
            'hash'   => 'hash',
            'nama'   => 'nama',
            'nick'   => 'nick',
            'alamat' => 'alamat',
            'telpon' => 'telpon',
            'tipe'   => 'tipe',
            'active' => 'active'
        ]);
        return parent::select($fields);
    }

    public function where($where)
    {
        $this->alias('where', [
            'hash' => 'd_agent.hash'
        ]);
        return parent::where($where);
    }
}
