<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Setting extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $model = new UserModel;
        $data['title']    = 'Account Settings';
        $data['userdata'] = $model->select([
            'email', 'verify_at'
        ])->where([
            'id' => userdata('id')
        ])->data(false);

        $this->plugin->set('scrollbar');
        return $this->view('setting/index', $data);
    }

    public function name()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change Full Name';
        $data['bread'] = ['Settings|setting', 'Change Full Name'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/name', $data);
    }

    public function email()
    {
        if (!is_login()) return $this->login();
        if (is_locked(uri_string())) return $this->unlock();

        $model = new UserModel;
        $email = $model->select(['email'])->where(['id' => userdata('id')])->data(false);

        $data['title'] = 'Change User Email';
        $data['bread'] = ['Settings|setting', 'Change Email'];
        $data['email'] = $email['email'];
        $data['flash'] = $this->session->getFlashdata('usedemail');

        $this->plugin->set('scrollbar|icheck');
        return $this->view('setting/change/email', $data);
    }

    public function username()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change Username';
        $data['bread'] = ['Settings|setting', 'Change Username'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/username', $data);
    }

    public function password()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change User Password';
        $data['bread'] = ['Settings|setting', 'Change Password'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/password', $data);
    }

    public function verify()
    {
        if (!is_login()) return $this->login();

        $limit = 900;
        $model = new UserModel;
        $data['title']    = 'Email Verification';
        $data['bread']    = ['Settings|setting', 'Email Verification'];
        $data['jscript']  = 'email.verification.min';
        $data['userdata'] = $model->select([
            'email', 'verify', 'verify_at'
        ])->where([
            'id' => userdata('id')
        ])->data(false);
        $data['countdown'] = 0;

        if ($data['userdata']['verify_at'] !== null) {
            throw PageNotFoundException::forPageNotFound();
        } else {
            if ($data['userdata']['verify'] !== null) {
                $create = id2date($data['userdata']['verify']);
                $difference = time() - strtotime($create);
                if ($difference < $limit) {
                    $data['countdown'] = $limit - $difference;
                }
            }
            $this->plugin->set('scrollbar|inputmask');
            return $this->view('setting/verification/email', $data);
        }
    }

    // ---------------------------------------------------------------------
    // -------- POST METHOD ------------------------------------------------

    public function emailChange()
    {
        if (!is_login()) return $this->login();

        $email  = $this->request->getPost('emailaddr');
        $verify = $this->request->getPost('verifynext') == 'on';

        $email  = strtolower(space_replace($email, '') . '');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return redirect()->to('setting/change/email');

        $model = new UserModel;
        $model->select(['id'])->where(['email' => $email]);
        $emailUser = $model->data(false)['id'] ?? null;

        if ($emailUser == userdata('id')) return redirect()->to('setting');
        if ($emailUser !== null) {
            $this->session->setFlashdata('usedemail', $email);
            return redirect()->to('setting/change/email');
        } else {
            if ($model->editEmail($email, userdata('id'))) {
                // success
            } else {
                // failed
            }
            remove_userdata('unlocked');
            return redirect()->to(
                $verify ? 'setting/verification/email' : 'setting'
            );
        }
    }

    public function verifyProcess()
    {
        if (!is_login()) return $this->login();

        $otpCode  = space_replace($this->request->getPost('verifyotp'), '');
        $model    = new UserModel;
        $userdata = $model->select(['verify', 'otp'])
            ->where(['id' => userdata('id')])->data(false);
        if (intval($otpCode) === intval($userdata['otp'])) {
            $update = $model->transaction(function ($db) use ($userdata) {
                $db->table('h_email_verify')->update(
                    array('verified' => date('Y-m-d H:i:s')),
                    array('id' => $userdata['verify'])
                );
            });
            if ($update) {
                // success
            } else {
                // failed
            }
            return redirect()->to('setting');
        } else {
            // wrong otp
            return redirect()->to('setting/verification/email');
        }
    }

    public function verifySend()
    {
        $status = array(
            'login'    => false,
            'userdata' => false,
            'sendmail' => false,
            'insert'   => false
        );
        if (!is_login()) return $this->response->setJSON(
            array('status' => $status)
        );
        $status['login'] = true;

        $model    = new UserModel;
        $userdata = $model->select([
            'email', 'nama'
        ])->where([
            'id' => userdata('id')
        ])->data(false);
        if ($userdata === null) return $this->response->setJSON(
            array('status' => $status)
        );
        $status['userdata'] = true;

        $otpCode  = mt_rand(100000, 999999);
        $email = new \App\Libraries\Email;
        $email
            ->setReceiver($userdata['email'], $userdata['nama'])
            ->setSubject('Email Verification OTP Code');
        $status['sendmail'] = $email->sendOTP($otpCode);

        if ($status['sendmail']) {
            $status['insert'] = $model->addVerification($otpCode, userdata('id'));
        }
        return $this->response->setJSON(array(
            'status' => $status
        ));
    }
}
