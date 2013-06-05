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

    protected function processContest()
    {

        $this->name    = $name    = $_POST['name'];
        $this->email   = $email   = $_POST['email'];
        $this->address = $address = $_POST['address'];
        $this->message = $message = $_POST['message'];

        $tmplTxt  = $this->modType . '/' . $this->modName . '/mail/contest.txt';
        $tmplHtml = $this->modType . '/' . $this->modName . '/mail/contest.html';

        if (defined('smtpPort'))
            $mail = new ivyMailer(smtpServer, smtpPort);
        else
            $mail = new ivyMailer(smtpServer);

        $mail->username = smtpUser;
        $mail->password = smtpPass;

        $mail->addTo(
            'victor@debian.org.ro',
            $this->coordinator['name']
        );

        $mail->setSubject('TFB :: Dance contest subscription');

        $messageTxt = $this->C->renderDisplay_fromObj($this, '', $tmplTxt);
        $messageHtml = $this->C->renderDisplay_fromObj($this, '', $tmplHtml);

        $mail->defineText($messageTxt);
        $mail->defineHtml($messageHtml);

        $mail->setFrom('vnitu@ceata.org', 'vnitu');

        $mail->send();

        file_put_contents('/srv/http/Ivy/mail.log', $mail->body);
    }

}
