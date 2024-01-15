<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Blanko extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Blanko Monitoring';
        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
