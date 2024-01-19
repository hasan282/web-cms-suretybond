<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Login';
        return $this->view('login/index', $data);
    }

    public function process()
    {
        $userOrEmail = $this->request->getPost('inputuser');
        $password    = $this->request->getPost('inputpass');
        $requestUri  = $this->request->getPost('urrequest');

        $result = 0;

<<<<<<< Updated upstream
        // var_dump($userOrEmail);
        // var_dump($password);
        // var_dump($requestUri);

        // $this->session->getFlashdata('');

        // $this->session->setFlashdata('');
=======
        $redirect = redirect()->to('' . $requestUri);
        if ($login['status']) {
            $userdata = array(
                'id'       => $login['data']['id'],
                'user'     => $login['data']['user'],
                'nama'     => $login['data']['nama'],
                'foto'     => $login['data']['image'],
                'agent'    => $login['data']['agent'],
                'agent_id' => $login['data']['agent_id'],
                'access'   => $login['data']['access_id']
            );
            $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
            if (empty($recaptchaResponse)) {
                $this->session->setFlashdata('error', 'Please complete the captcha.');
                return redirect()->to('/');
            } else {
                set_userdata($userdata);
                set_cookie('USRLOG', $login['data']['hash'], 60 * 60 * 24 * 5);
                $redirect->withCookies();
            }
        } else {
            if (empty($login['data'])) {
                $this->session->setFlashdata('message', 'Account is Not Registered');
                $this->session->setFlashdata('invalid', 'user');
            } else {
                $this->session->setFlashdata('message', 'Your Password is Incorrect');
                $this->session->setFlashdata('invalid', 'pass');
                $this->session->setFlashdata('username', $login['data']['user']);
            }
        }
        return $redirect;
    }
>>>>>>> Stashed changes

        return redirect()->to('');
    }
}
