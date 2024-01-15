<?php

namespace App\Libraries;

class Email
{
    private $config, $setting;

    public function __construct()
    {
        $this->config    = array(
            'protocol'   => 'smtp',
            'mailType'   => 'html',
            'SMTPHost'   => getenv('email_host'),
            'SMTPUser'   => getenv('email_user'),
            'SMTPPass'   => getenv('email_pass'),
            'SMTPPort'   => getenv('email_port'),
            'SMTPCrypto' => 'ssl'
        );
        $this->setting   = array(
            'sender'     => 'JIS Suretybond',
            'receiver'   => null,
            'subject'    => 'Pengiriman Email',
            'viewpath'   => 'email/basic'
        );
    }

    public function sendOTP(int $otp)
    {
        $this->setting['viewpath'] = 'email/basic';

        $data = array(
            'name' => $this->setting['name'],
            'otp' => '' . $otp
        );
        return $this->send($data);
    }

    private function send(array $data = [])
    {
        if ($this->setting['receiver'] === null) return false;

        $email = \Config\Services::email($this->config);

        $email->setFrom(
            $this->config['SMTPUser'],
            $this->setting['sender']
        );
        $email->setTo($this->setting['receiver']);
        $email->setSubject($this->setting['subject']);

        $mailcontent = space_replace(view($this->setting['viewpath'], $data));
        $email->setMessage($mailcontent);

        return $email->send();
    }

    public function setReceiver(string $email, ?string $name = null)
    {
        $this->setting['receiver'] = $email;
        $this->setting['name'] = $name === null ? $email : $name;
        return $this;
    }

    public function setSubject(string $subject)
    {
        $this->setting['subject'] = $subject;
        return $this;
    }
}
