<?php

namespace App\Models;

use App\Models\Core\BaseModel;

class MenuModel extends BaseModel
{
    public function select(array $fields = [])
    {
        $this->fields('c_menu', [
            'id'    => 'id',
            'text'  => 'text',
            'icon'  => 'icon',
            'url'   => 'url',
            'group' => 'id_group'
        ]);
        $this->fields('c_menu_group', [
            'group_id'   => 'id',
            'group_text' => 'text',
            'group_icon' => 'icon'
        ]);
        $this->join('c_menu.id_group=c_menu_group.id', 'left');
        return parent::select($fields);
    }
}
