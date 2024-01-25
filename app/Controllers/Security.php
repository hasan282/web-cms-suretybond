<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Security extends BaseController
{
    public function index()
    {
        $uri = $this->session->getFlashdata('destination');
        if ($uri === null) return redirect()->to('');

        $data['title'] = 'Password Confirmation';
        $data['uri']   = $uri;

        return $this->view('login/lockscreen', $data);
    }

    public function auth()
    {
        if (!is_login()) return redirect()->to('');

        $destinate = $this->request->getPost('destination') . '';
        $password  = $this->request->getPost('inputpassverif') . '';

        $model     = new \App\Models\UserModel;
        $userdata  = $model->select(['pass'])->where([
            'id' => userdata('id')
        ])->data(false);

        if (sha3hash($password, 50) === $userdata['pass']) {
            uri_unlock($destinate);
            return redirect()->to($destinate);
        } else {
            $this->session->setFlashdata('message', 'Your password is incorrect.');
            $this->session->setFlashdata('destination', $destinate);
            return redirect()->to('account/verification');
        }
    }
}
