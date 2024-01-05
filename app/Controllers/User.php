<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'User Profile';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
