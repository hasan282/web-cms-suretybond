<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Report extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Report and Analytics';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
