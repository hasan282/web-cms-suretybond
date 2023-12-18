<?php

namespace App\Models\Dummy;

class Menu
{
    public static function get(): array
    {
        return array(
            [
                'text'       => 'Menu Satu',
                'icon'       => 'fas fa-database',
                'url'        => '#satu',
                'group'      => null,
                'group_text' => null,
                'group_icon' => null
            ],
            [
                'text'       => 'Submenu Dua 1',
                'icon'       => 'fas fa-clone',
                'url'        => '#duasatu',
                'group'      => '1',
                'group_text' => 'Menu Dua',
                'group_icon' => 'fas fa-layer-group'
            ],
            [
                'text'       => 'Submenu Dua 2',
                'icon'       => 'fas fa-clone',
                'url'        => '#duadua',
                'group'      => '1',
                'group_text' => 'Menu Dua',
                'group_icon' => 'fas fa-layer-group'
            ],
            [
                'text'       => 'Submenu Dua 3',
                'icon'       => 'fas fa-clone',
                'url'        => '#duatiga',
                'group'      => '1',
                'group_text' => 'Menu Dua',
                'group_icon' => 'fas fa-layer-group'
            ],
            [
                'text'       => 'Submenu Tiga 1',
                'icon'       => 'fas fa-clone',
                'url'        => '#tigasatu',
                'group'      => '2',
                'group_text' => 'Menu Tiga',
                'group_icon' => 'fas fa-landmark'
            ],
            [
                'text'       => 'Submenu Tiga 2',
                'icon'       => 'fas fa-clone',
                'url'        => '#tigadua',
                'group'      => '2',
                'group_text' => 'Menu Tiga',
                'group_icon' => 'fas fa-landmark'
            ],
            [
                'text'       => 'Submenu Tiga 3',
                'icon'       => 'fas fa-clone',
                'url'        => '#tigatiga',
                'group'      => '2',
                'group_text' => 'Menu Tiga',
                'group_icon' => 'fas fa-landmark'
            ],
            [
                'text'       => 'Menu Empat',
                'icon'       => 'fas fa-dice-d6',
                'url'        => '#empat',
                'group'      => null,
                'group_text' => null,
                'group_icon' => null
            ],
            [
                'text'       => 'Menu Lima',
                'icon'       => 'fas fa-lock',
                'url'        => '#lima',
                'group'      => null,
                'group_text' => null,
                'group_icon' => null
            ]
        );
    }
}
