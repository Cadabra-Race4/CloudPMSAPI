<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Mail;

class SendmailRepository {

    protected $nameFrom;
    protected $nameTo;
    protected $mailFrom;
    protected $mailTo;

    public function __construct()
    {
        $this->mailFrom = config('const.mail_system.address');
        $this->nameFrom = config('const.mail_system.name');
    }

    /**
     * Set the email sender name
     * @param string $name
     */
    public function setNameFrom ($name) {
        $this->nameFrom = $name;
    }

    /**
     * Set up the name of the recipient
     * @param string $name
     */
    public function setNameTo ($name) {
        $this->nameTo = $name;
    }

    /**
     * Set the address of the sender
     * @param string $email
     */
    public function setMailFrom ($email) {
        $this->mailFrom = $email;
    }

    /**
     * Set up the address of the mailer
     * @param string $email
     */
    public function setMailTo ($email) {
        $this->mailTo = $email;
    }

    /**
     * Send mail forget password
     * @param array $data
     * @return boolean
     */
    public function SendMailForgotPassword ($data) {
        $subject = 'Password reset request for your account';
        $template = 'Mail.forgot-password';
        $this->SendEmail($subject, $template, $data);
        return true;
    }

    private function SendEmail ($subject, $templateName, $data) {
        Mail::send($templateName, $data, function ($message) use ($subject) {
            $message->to($this->mailTo, $this->nameTo)->subject($subject);
            $message->from($this->mailFrom, $this->nameFrom);
        });
    }
}