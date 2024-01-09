<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Insurance extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'List of Insurance';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function add(): string
    {
        $data['title'] = 'Add New Insurance';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
