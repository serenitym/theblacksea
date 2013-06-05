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

    protected function mailSignup_managers()
    {


        /**
         * USE :
         *
         * $this->psts->
         *
            events_signup_posts:
              usr_name: ""
              usr_email: ""
              usr_address: ""
              usr_more: ""
              captcha_code: ""

              ev_name: ""
              ev_price: ""
              ev_description: ""
              ev_date: ""
              ev_hour: ""
              ev_location: ""
              ev_managersEmails: ""

        */

        /**
         * $mail->addTo(
            $this->coordinator['email'],
            $this->coordinator['name']
           );

           $mail->setFrom('vnitu@ceata.org', 'vnitu');

        */

        if (defined('smtpPort'))
            $mail = new ivyMailer(smtpServer, smtpPort);
        else
            $mail = new ivyMailer(smtpServer);

        $mail->username = smtpUser;
        $mail->password = smtpPass;

        $tmplTxt  = "{$this->modType}/{$this->modName}/tmpl_{$this->template}"
                  . "/tmpl/mail/mailSignup_managers.txt";

        $tmplHtml = "{$this->modType}/{$this->modName}/tmpl_{$this->template}"
                  . "/tmpl/mail/mailSignup_managers.html";

        $messageTxt = $this->C->renderDisplay_fromObj($this, '', $tmplTxt);
        $messageHtml = $this->C->renderDisplay_fromObj($this, '', $tmplHtml);

        //======================================================================

        // from first mail defined
        $mail->setFrom(trim($this->psts->managers[0]), 'Tribal Fest');


        // from rest of mails
        foreach ($this->psts->managers AS $key => $address) {
            $mail->addTo(trim($address));
        }


        $mail->setSubject('TFB :: '.$this->psts->ev_name.' subscription');

        $mail->defineText($messageTxt);
        $mail->defineHtml($messageHtml);

        $mail->send();


    }

    protected function mailSignup_subscriber()
    {
            /**
             * USE :
             *
             * $this->psts->
             *
                events_signup_posts:
                  usr_name: ""
                  usr_email: ""
                  usr_address: ""
                  usr_more: ""
                  captcha_code: ""

                  ev_name: ""
                  ev_price: ""
                  ev_description: ""
                  ev_date: ""
                  ev_hour: ""
                  ev_location: ""
                  ev_managersEmails: ""

            */


            if (defined('smtpPort'))
                $mail = new ivyMailer(smtpServer, smtpPort);
            else
                $mail = new ivyMailer(smtpServer);

            $mail->username = smtpUser;
            $mail->password = smtpPass;


            //==================================================================

            // from first mail defined
            $mail->setFrom(trim($this->psts->managers[0]), 'Tribal Fest');


            // from rest of mails
            $mail->addTo($this->psts->usr_email);

            $mail->setSubject('TFB :: '.$this->psts->ev_name.' subscription');

            $tmplTxt = "{$this->modType}/{$this->modName}/tmpl_"
                     . "{$this->template}/tmpl/mail/mailSignup_subscriber.txt";

            $tmplHtml = "{$this->modType}/{$this->modName}/tmpl_"
                     . "{$this->template}/tmpl/mail/mailSignup_subscriber.html";

            $messageTxt = $this->C->renderDisplay_fromObj($this, '', $tmplTxt);
            $messageHtml = $this->C->renderDisplay_fromObj($this, '', $tmplHtml);

            $mail->defineText($messageTxt);
            $mail->defineHtml($messageHtml);

            $mail->send();


    }




}
