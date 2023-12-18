<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $this->plugin->set('scrollbar');
        return $this->view('layout/blank');
    }

    public function table(): string
    {
        $data['title'] = 'Table';
        $data['bread'] = ['Home|', 'Table'];

        $this->plugin->set('scrollbar');
        return $this->view('table/example', $data);
    }
}
