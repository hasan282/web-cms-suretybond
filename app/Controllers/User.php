<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'User Profile';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function manage()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Manage User Account';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
