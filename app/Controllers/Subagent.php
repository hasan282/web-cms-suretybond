<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Subagent extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'List of Subagent';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    public function add()
    {
        if (!is_login()) return $this->login();

        if (role_is([101, 201])) {

            $data['title'] = 'Add New Subagent';

            $this->plugin->set('scrollbar');
            return $this->view('layout/blank', $data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
