<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\tokenModel;
use App\Models\UserModel;

class ForgotPassword extends BaseController
{
    public function index()
    {
        $data['title'] = 'Forgot-password';

        $this->plugin->set('scrollbar');
        return $this->view('login/forgot', $data);
    }

    public function sendEmail()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'email' => 'required|valid_email|is_not_unique[d_user.email]',
        ];
        $messages = [
            'email' => [
                'required' => 'Email is required.',
                'valid_email' => 'Please check email field. It does not appears to be valid.',
                'is_not_unique' => 'Email not exists in system'
            ],
        ];
        if ($this->validate($rules, $messages)) {
            $this->session->setFlashdata('success', 'We send you link for reset password in your email inbox.');
            return redirect()->to('forgot');
        } else {
            session()->setFlashdata('emailerr', $validation->getError('email'));
            return redirect()->back()->withInput();
        }
    }

    public function resetPassword()
    {
    }
}
