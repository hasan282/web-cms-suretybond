<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Setting extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Setting';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
