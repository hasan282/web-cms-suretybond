<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'User Profile';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function manage()
    {
        if (!is_login()) return $this->login();

        if (!role_is([101, 201])) {
            throw PageNotFoundException::forPageNotFound();
        } else {

            $data['title'] = 'Manage User Account';

            $this->plugin->set('scrollbar');
            return $this->view('layout/blank', $data);
        }
    }
}
