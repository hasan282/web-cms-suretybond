<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Dashboard';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
