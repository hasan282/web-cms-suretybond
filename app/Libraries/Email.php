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
            'sender'     => 'PTJIS Suretybond',
            'receiver'   => null,
            'subject'    => 'Pengiriman Email',
            'viewpath'   => 'layout/email',
            'title'      => '-',
            'name'       => null,
            'content'    => '-',
            'link'       => '#',
            'button'     => 'Klik Disini'
        );
    }

    public function send()
    {
        if ($this->setting['receiver'] === null) return false;

        $email = \Config\Services::email($this->config);

        $email->setFrom(
            $this->config['SMTPUser'],
            $this->setting['sender']
        );
        $email->setTo($this->setting['receiver']);
        $email->setSubject($this->setting['subject']);
        $data = array(
            'mail_title'    => $this->setting['title'],
            'mail_receiver' => $this->setting['name'] ?? $this->setting['receiver'],
            'mail_content'  => $this->setting['content'],
            'mail_link'     => $this->setting['link'],
            'button_text'   => $this->setting['button']
        );
        $mailcontent = space_replace(view($this->setting['viewpath'], $data));
        $email->setMessage($mailcontent);

        return $email->send();
    }

    public function setReceiver(string $email, ?string $name = null)
    {
        $this->setting['receiver'] = $email;
        if ($name !== null)
            $this->setting['name'] = $name;
        return $this;
    }

    public function setTitle(string $subject, string $title)
    {
        $this->setting['subject'] = $subject;
        $this->setting['title']   = $title;
        return $this;
    }

    public function setContent(string $content)
    {
        $this->setting['content'] = $content;
        return $this;
    }

    public function setButton(string $text, string $link)
    {
        $this->setting['button'] = $text;
        $this->setting['link']   = $link;
        return $this;
    }
}
