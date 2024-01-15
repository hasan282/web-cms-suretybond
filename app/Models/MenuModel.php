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
        $this->fields('c_menu_access', [
            'access_id' => 'id',
            'access'    => 'id_access',
            'menu_id'   => 'id_menu'
        ]);
        $this->join('c_menu.id_group=c_menu_group.id', 'left');
        $this->join('c_menu.id=c_menu_access.id_menu');
        return parent::select($fields);
    }

    public function where($where)
    {
        $this->alias('where', [
            'role' => 'c_menu_access.id_access'
        ]);
        return parent::where($where);
    }

    public function order($order)
    {
        $this->alias('order', [
            'id' => 'c_menu.id ASC'
        ]);
        return parent::order($order);
    }
}
