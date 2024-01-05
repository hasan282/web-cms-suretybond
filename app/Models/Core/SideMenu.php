<?php

namespace App\Models\Core;

class SideMenu
{
    private array $menu;

    public static function get($role)
    {
        $menu = new self;
        $menu->setdata(intval($role));

        return $menu->compile();
    }

    private function setdata(int $role)
    {
        $model = new \App\Models\MenuModel;
        $this->menu = $model->select([
            'text', 'icon', 'url', 'group', 'group_text', 'group_icon'
        ])->order('c_menu.id ASC')->data();
    }

    private function compile(): array
    {
        $compiled = array();
        foreach ($this->menu as $menu) {
            $block = strpos($menu['url'], '#') === 0;
            $active = !$block && url_is($menu['url'] . '*');
            if ($menu['group'] === null) {
                $compiled[] = array(
                    'text'   => $menu['text'],
                    'icon'   => $menu['icon'],
                    'active' => $active,
                    'url'    => $menu['url'],
                    'subs'   => array(),
                    'group'  => null
                );
            } else {
                foreach ($compiled as $pos => $comp) {
                    if ($comp['group'] == $menu['group']) {
                        $compiled[$pos]['subs'][] = array(
                            'text'   => $menu['text'],
                            'icon'   => $menu['icon'],
                            'active' => $active,
                            'url'    => $menu['url']
                        );
                        if ($active) $compiled[$pos]['active'] = true;
                        continue 2;
                    }
                }
                $compiled[] = array(
                    'text'   => $menu['group_text'],
                    'icon'   => $menu['group_icon'],
                    'active' => $active,
                    'url'    => '#',
                    'subs'   => array(
                        [
                            'text'   => $menu['text'],
                            'icon'   => $menu['icon'],
                            'active' => $active,
                            'url'    => $menu['url']
                        ]
                    ),
                    'group'  => $menu['group']
                );
            }
        }
        return $compiled;
    }
}
