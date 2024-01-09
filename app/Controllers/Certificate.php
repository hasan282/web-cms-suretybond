<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Certificate extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'List of Certificate';

        $this->plugin->set('scrollbar');
        return $this->view('certificate/index', $data);
    }

    public function add(): string
    {
        $data['title'] = 'Add New Certificate';

        $this->plugin->set('scrollbar');
        return $this->view('layout/blank', $data);
    }

    private function email()
    {
        $email = new \App\Libraries\Email;
        $email
            ->setReceiver('hsn.abdullah282@gmail.com', 'Hasan Abdullah')
            ->setTitle('Aktivasi Akun Kamu Dulu Yuk', 'Aktivasi Akun')
            ->setContent('Selamat datang di Aplikasi Suretybond, untuk keamanan akun kamu aktivasi dulu akunmu dengan klik link atau tombol dibawah ini :')
            ->setButton('Aktivasi Akun Sekarang', 'https://suretybond.ptjis.id/');
        $email->send();
    }
}
