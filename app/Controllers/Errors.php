<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Errors extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Page Not Found';

        if (is_login()) {
            $this->plugin->set('scrollbar');
            return $this->view('errors/custom/admin', $data);
        } else {
            return $this->view('errors/custom/general', $data);
        }
    }
}
