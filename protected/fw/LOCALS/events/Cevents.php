<?php

class Cevents extends eventRegister
{


    var $members,
        $events,
        $member;

    function payment_confirmation(){

        $query = "UPDATE events_registrations SET usr_status = 1 WHERE idSub = {$_GET['idSub']}";
        $this->DB->query($query);

        //echo $query;


        // get statistics
        $query_subs = " SELECT events.idEv,
                                events.ev_name,
                                events.ev_managersEmails,

                                events_registrations.idSub,
                                events_registrations.ev_price,
                                events_registrations.usr_name,
                                events_registrations.usr_email,
                                events_registrations.usr_address,
                                events_registrations.sub_date,
                                events_registrations.usr_status

                                FROM events JOIN events_registrations ON (events.idEv = events_registrations.idEv)

                                ";

       $query_subs_unconf      = $query_subs . " WHERE usr_status = 0 ORDER BY events_registrations.idSub desc";
       $this->subEvents_unconf = $this->C->Handle_Db_fetch($this, $query_subs_unconf);


       $query_subs_conf      = $query_subs . " WHERE usr_status = 1 ORDER BY events_registrations.idSub desc";
       $this->subEvents_conf = $this->C->Handle_Db_fetch($this, $query_subs_conf);



       $this->totalSubs_unconf = count($this->subEvents_unconf) ;
       $this->totalSubs_conf   = count($this->subEvents_conf);
       $this->totalSubs        = $this->totalSubs_unconf + $this->totalSubs_conf;

    }

    function payment_feedback(){

        $query = " SELECT events.idEv,
                          events.ev_name,
                          events.ev_managersEmails,

                          events_registrations.idSub,
                          events_registrations.ev_price,
                          events_registrations.usr_name,
                          events_registrations.usr_email,
                          events_registrations.usr_address,
                          events_registrations.sub_date

                          FROM events JOIN events_registrations ON (events.idEv = events_registrations.idEv)

                           WHERE events.idEv = {$_GET['idEv']} && idSub = {$_GET['idSub']}
                          ";

        $this->subEvent = new stdClass();
        $this->C->Handle_Db_fetch($this->subEvent, $query);

        $this->subEvent->ev_name = htmlspecialchars_decode($this->subEvent->ev_name, ENT_QUOTES);
        // error_log("************** decoded ev_name  ".$this->subEvent->ev_name  );

        $this->psts = &$this->subEvent;
        $this->psts->managers = explode(',', $this->psts->ev_managersEmails);

        $this->mailSignup_managers('mailSignup_payment', ' payment confirmation ');
        //var_dump($this->subEvent);
        //var_dump($this->subEvents);
       // echo $query;

    }



    function valid_signupForm(){

        $_POST['usr_name']    = trim(strip_tags($_POST['usr_name']   ));
        $_POST['usr_email']   = trim(strip_tags($_POST['usr_email']  ));
        $_POST['usr_address'] = trim(strip_tags($_POST['usr_address']));

        require "./assets/securimage/securimage.php";
        $securimage = new Securimage();

        //$this->env = new Envelope($this->envelopeData);

        $feedback = "";

        $feedback .= $_POST['usr_name'] ? "" : "<p class='highligth-color'> Name field is empty </p>";
        $feedback .= $_POST['usr_email'] ? "" : "<p class='highligth-color'> Email field is empty </p>";
        $feedback .= $securimage->check($_POST['captcha_code']) == TRUE
            ? ""
            : "<p class='highligth-color'> Wrong CAPTCHA code </p> "
                        //   .($securimage->check($_POST['captcha_code']) == TRUE ? "cod corect" : "cod INcorect")
                        //  . ' are metoda '.method_exists($securimage, 'check')
                        // .' este obiect = '.is_object($securimage)
                        // .$_POST['captcha_code']
        ;


        if($feedback){

            $feedback = "<div class='formFBK'> <p class='highligth-color b'> Errors: </p> $feedback </div>";
            echo $feedback;

        } else {
            $query = "SELECT FROM events_registrations
                            WHERE usr_email = '".$_POST['usr_name']."'  AND idEv = {$_POST['idEv']} ";
            $this->DB->query($query);

            if($this->DB->num_rows > 0)
            {
                $feedback =  "<div class='formFBK'>
                                <p class='highligth-color b'> Warning: </p>
                                You have already singedup to this event!!!
                              </div>";
                echo $feedback;

            }

        }
        //if(!$feedback) echo "<div class='formFBK'> in validare signupform</div>";


    }

    function check_promoWs(){

        // id-uri de eventuri excluse din promotie
        $notPromos_idEv = array(4, 5 , 6, 10, 12, 16);
        $promo = in_array($_POST['idEv'] , $notPromos_idEv) ? false : true;


       // if( (isset($_POST['evType']) && $_POST['evType']=='workshop') || $_POST['idEv'] == 17 )
        if($promo)
        {
             $curr_timeStamp = time();
             $endPromo_timeStamp =  mktime(0, 0, 0, 9, 1, 2013);

             if($curr_timeStamp <= $endPromo_timeStamp)
                $this->psts->ev_price -= $this->psts->ev_price * 0.1;

        }


    }

    function eventSignup(){
       // var_dump($_POST);
       //events_signup_posts

       /**
        * $opsts = new CgetPosts($this->events_signup_posts);
        $opsts->set_psts('strict');
        var_dump($opsts->psts);*/


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



       $this->psts = new stdClass();
       CgetPosts::set_allPsts($this->psts);

       $this->check_promoWs();
       $this->psts->managers = explode(',', $this->psts->ev_managersEmails);
      // var_dump($this->psts);


       // retine datele subscriberului in BD
       $queryEv = "INSERT into events_registrations
                                           (idEv, ev_price, usr_name, usr_email, usr_address, sub_date )
                                    values ({$this->psts->idEv},
                                            {$this->psts->ev_price},
                                           '{$this->psts->usr_name}' ,
                                           '{$this->psts->usr_email}' ,
                                           '{$this->psts->usr_address}',
                                            NOW()
                                             )";

       $this->DB->query($queryEv);
       $this->psts->idSub = $this->DB->insert_id;



       // daca sunt setati managerii la care sa se trimita mailuri
       if(count($this->psts->managers) > 0)
       {
            $this->mailSignup_managers();
            $this->mailSignup_subscriber();
       }

       unset($_POST);

        //echo ' eventSignup '.$queryEv;
    }




    function process_event($event){

        // daca nu are un pretz setat , atunci cauta in events_vars

        if(!$event['ev_price'])
        {
            $query_prices = "SELECT * from events_vars WHERE idEv = {$event['idEv']}";
            $event['prices'] = $this->C->Handle_Db_fetch($this, $query_prices,'',false);


            $prices = array();
            foreach($event['prices'] AS $priceVar){
                array_push($prices, $priceVar['ev_nameVar'].'='.$priceVar['ev_price']);
            }
            $event['pricesStr'] = implode(' , ',$prices);

            //echo "for {$event['idEv']} we have {$event['pricesStr']} <br>";
            //var_dump($event['prices']);

        }


        $event['ev_date_atmpl']     =   $event['ev_date'] ? "" : "ATmpl";
        $event['ev_hour_atmpl']     =   $event['ev_hour'] ? "" : "ATmpl";
        $event['ev_location_atmpl'] =   $event['ev_location'] ? "" : "ATmpl";
        $event['ev_price_atmpl']    =   $event['ev_price'] ? "" : "ATmpl";
        $event['ev_prices_atmpl']   =   $event['prices'] ? "" : "ATmpl";



        return $event;
    }
    function get_events($idM = 0, $idEv = '', $exception = " AND idEv != 6 " ){

        $where = $idEv ? " AND idEv = $idEv " : "";


        $query_events = "SELECT

                            idEv             ,
                            idExt            ,
                            ev_name,
                            ev_description   ,
                            ev_date          ,
                            ev_hour          ,
                            ev_location      ,
                            ev_price         ,
                            ev_managersEmails,
                            ev_formType      
                            
                            
                            from events WHERE idExt = $idM  {$where}  {$exception} ";
        $this->events[$idM] = new stdClass();
        $this->events[$idM]->idM = $idM;
        $this->events[$idM]->listEvents = $this->C->Handle_Db_fetch($this, $query_events,'process_event');

        //echo "get_events query = ".$query_events."<br>";
        return "";
    }

    function process_member($member){

        $idM = $member['idM'];

        // $idPers_str = $this->admin ? "aidPers" : "idPers";
        $member['mbr_href'] = !isset($_GET['idPers']) ? "?idc={$this->idNode}&idT={$this->idTree}&idPers={$idM}" : "#";
        $this->get_events($idM);

        return $member;


    }
    function get_members($idM = '', $processMeth = 'process_member'){

        $where = $idM ? " WHERE idM = $idM" : "";

        $query_members = "SELECT * from members {$where}";
        $this->members = $this->C->Handle_Db_fetch($this, $query_members, $processMeth);

    }

    function get_evMbr($idM, $idEv){

        $this->get_members($idM, '');
        $this->get_events($idM, $idEv);

    }

    function get_workshops(){

        //mai mult pentru partea de admin
        if(isset($_POST['go_signup_ws'])){

            $this->set_template('go_signup_ws');
            $this->get_evMbr($_POST['idM'], $_POST['idEv']);
        }
        elseif(isset($_GET['idPers']))
        {
            $idPers_str = $this->admin ? "aidPers" : "idPers";
            $this->set_template($idPers_str);
            $this->get_members($_GET['idPers']);
        }

        else{
            $this->get_members();
        }


       // var_dump($this->members);
       // var_dump($this->events);
    }


    function set_template($tmplSetter){


        if($this->templates[$tmplSetter])
        {
            $this->template_file = $this->templates[$tmplSetter];
            return true;
        }
        else
            return false;

    }

/**
 * ======[ This module has access to ]=======================
 *
 *  $mod->C                     # obiectul principal core
 *
    # situatie core
    $mod->DB     =              # pointer la BD
    $mod->admin  =              # true / false - daca sunt pe admin
    $mod->LG     =              # limba curenta
    $mod->lang   =              # limba curenta
    $mod->nodeResFile  =              # numele de RES al paginii/ categoriei curente in limba curenta
 *                                 ex: name: Categorie Noua = Categorie_noua


    # date ale modu
    $mod->idNode    =             # id-ul categoriei curente
    $mod->idTree    =             # id-ul parintelui originar
    $mod->level  =             # levelul din tree la care se afla cat
    $mod->mgrName   =             # tipul categoriei curente ex: MODELS / LOCALS


    #date despre acest modul
    $mod->modName =            # numele modulului
    $mod->modType =            # tipul acestuia : GENERAL/ LOCALS /MODELS/ PLUGINS
 *
 *
 *
 * =====[ USABLE DB - methods ]=================================
 *
 *    Db_Get_rows ($result, $method = 'fetch_assoc')
 *        * returneaza un array multdimensional cu datele returnate de $result
 *
 *
 *    Handle_Db_fetch(&$mod,$query,$processResMethod='', $onlyArr = false)
 *
 *      *  $mod                              - obiectul care a apelat metoda
        *  $query                            - query-ul de procesat
        *  string $processResMethod($row)    - metoda a $mod care proceseaza orice rand returnat
        *  bool $onlyArr                     - daca queryul ret un singur record
        *                                              false - va seta valoriile ret la mod
        *                                              true - va returna un array[0] = array(colum=>value);
        * return array                     - array muldimensional cu toate recordurile returnate de query
        *                                      si procesate de processResMethod
 *
 *   USE LIKE this
 *      $this->news = $this->C->Handle_Db_fetch($this, $query, 'procesNews');
 *
 *   =>$this->news = array(0=> [title=>'', content=>'', idNews=>'' ], 1=> [], ...);
 *
 *
*/
    /**
     * Apelata imediat dupa instantierea modulului
     * like a second __construct()
     */

    function _init_(){

        // ADMISNISTARRE ACTIUNI
        // daca se face singup
        if(isset($_POST['methName']) && $_POST['methName'] == 'eventSignup')
        {
            $this->template_file = 'signup_feedback';

        }
        // daca se doreste o confirmare de paymentt
        elseif( isset($_GET['idEv']) && isset($_GET['idSub']) ){

            // - 1 - din partea managerilor
            if($this->admin && isset($_GET['confirm'])){

                $this->template_file = 'payment_confirmation';
                $this->payment_confirmation();
            }
            // -2 - din partea subscriberului
            else{
                $this->template_file = 'payment_feedback';
                $this->payment_feedback();
            }

        }

        // progresare in paginile administrate de Cevents
        elseif(isset($this->templates))
        {
            $tmplFile_stat = $this->set_template($this->idNode);

            if($tmplFile_stat && method_exists($this, 'get_'.$this->template_file))
            {
                $this->{'get_'.$this->template_file}();

            }

        }


    }


    function __construct(&$C){


    }

}
