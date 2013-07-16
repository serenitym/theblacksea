<?php

class eventRegister
{



    protected function mailSignup_managers($tmpl_file = 'mailSignup_managers', $mailTitle = ' subscription ')
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

        if (defined('SMTP_PORT'))
            $mail = new ivyMailer(SMTP_SERVER, SMTP_PORT);
        else
            $mail = new ivyMailer(SMTP_SERVER);

        $mail->username = SMTP_USER;
        $mail->password = SMTP_PASS;

        //======================================================================

        $tmplTxt  = "{$this->modType}/{$this->modName}/tmpl_{$this->template}"
                  . "/tmpl/mail/{$tmpl_file}.txt";

        $tmplHtml = "{$this->modType}/{$this->modName}/tmpl_{$this->template}"
                  . "/tmpl/mail/{$tmpl_file}.html";

        $messageTxt = $this->C->Render_object($this, 'path', $tmplTxt);
        $messageHtml = $this->C->Render_object($this, 'path', $tmplHtml);

        //======================================================================

        // from first mail defined
        $mail->setFrom(trim($this->psts->managers[0]), 'Tribal Fest');


        // from rest of mails
        foreach ($this->psts->managers AS $key => $address) {
            $mail->addTo(trim($address));
        }


        $mail->setSubject('TFB :: '.$this->psts->ev_name.$mailTitle);

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


            if (defined('SMTP_PORT'))
                $mail = new ivyMailer(SMTP_SERVER, SMTP_PORT);
            else
                $mail = new ivyMailer(SMTP_SERVER);

            $mail->username = SMTP_USER;
            $mail->password = SMTP_PASS;


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

            $messageTxt = $this->C->Render_object($this, 'path', $tmplTxt);
            $messageHtml = $this->C->Render_object($this, 'path', $tmplHtml);

            $mail->defineText($messageTxt);
            $mail->defineHtml($messageHtml);

            $mail->send();


    }




}
