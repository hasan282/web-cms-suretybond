<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Subagent extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'List of Subagent';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function add()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Add New Subagent';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
