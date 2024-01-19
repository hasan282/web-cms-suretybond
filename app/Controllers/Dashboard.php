<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Dashboard';

        $this->plugin->set('scrollbar');
        return $this->view('dashboard/index', $data);
    }
}
