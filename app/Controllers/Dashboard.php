<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!is_login()) return redirect()->to('');

        $data['title'] = 'Dashboard';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }
}
