<?php

namespace App\Controllers;

class Certificate extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'List of Certificate';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
