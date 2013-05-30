<?php

class eventRegister
{

    public function setOrderData($action)
    {
        switch($action){
        case 'contest':
            $this->processContest();
            break;
        case 'workshop':
            // do stuff
            break;
        }

        return null;
    }

    protected function processContest() {

        $this->name    = $name    = $_POST['name'];
        $this->email   = $email   = $_POST['email'];
        $this->address = $address = $_POST['address'];
        $this->message = $message = $_POST['message'];

        $tmplTxt = $this->modType . '/' . $this->modName . '/mail/contest.txt';

        if (defined('smtpPort'))
            $mail = new ivyMailer(smtpServer, smtpPort);
        else
            $mail = new ivyMailer(smtpServer);

        $mail->username = smtpUser;
        $mail->password = smtpPass;

        $mail->addTo(
            $this->coordinator['email'],
            $this->coordinator['name']
        );

        $mail->setSubject('TFB :: Dance contest subscription');

        $message = $this->C->renderDisplay_fromObj($this, '', $tmplTxt);

        $mail->defineText($message);
        $mail->setFrom('vnitu@ceata.org', 'vnitu');

        $mail->send();
    }

}
