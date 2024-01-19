<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'List of Principal';

        $this->plugin->set('scrollbar');
        return $this->view('principal/index', $data);
    }

    public function add()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Add New Principal';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
