<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'List of Principal';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function add(): string
    {
        $data['title'] = 'Add New Principal';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
