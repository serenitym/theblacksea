<?php

class Cevents extends eventRegister
{


    var $members,
        $events,
        $member;

    function valid_signupForm(){

        $_POST['usr_name']    = trim(strip_tags($_POST['usr_name']   ));
        $_POST['usr_email']   = trim(strip_tags($_POST['usr_email']  ));
        $_POST['usr_address'] = trim(strip_tags($_POST['usr_address']));

        $feedback = "";

        $feedback .= $_POST['usr_name'] ? "" : "<p class='highligth-color'> Name field is empty </p>";
        $feedback .= $_POST['usr_email'] ? "" : "<p class='highligth-color'> Email field is empty </p>";


        if($feedback){

            $feedback = "<p class='highligth-color b'> Errors: </p>".$feedback;
            echo $feedback;

        } else {
            $query = "SELECT FROM events_registrations
                            WHERE usr_email = '".$_POST['usr_name']."'  AND idEv = {$_POST['idEv']} ";
            $this->DB->query($query);

            if($this->DB->num_rows > 0)
            {
                $feedback =  "<p class='highligth-color b'> Warning: </p>"."You have already singedup to this event!!!";
                echo $feedback;

            }

        }


    }

    function check_promoWs(){

        // daca s-a facut signup pentru workshop

        if(isset($_POST['evType'])){



            $stat_deal = strpos($this->psts->ev_name, 'deal');

            /**
             * daca workshopul nu este un deal
             *
             * - testeaza daca este data curenta la care s-a facut signup este
             * mai mica de 1 sept 2013
             * - daca da fa un discount la pret de 10%
             */

            if($stat_deal === false && $stat_deal){
              //  echo "Este un workshop {$stat_deal} <br> ";

                $curr_timeStamp = time();
                $endPromo_timeStamp =  mktime(0, 0, 0, 9, 1, 2013);

                if($curr_timeStamp <= $endPromo_timeStamp)
                    $this->psts->ev_price -= $this->psts->ev_price * 0.1;
            }

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
       // var_dump($this->psts);

       $this->check_promoWs();
       // daca sunt setati managerii la care sa se trimita mailuri
       $this->psts->managers = explode(',', $this->psts->ev_managersEmails);
       if(count($this->psts->managers) > 0)
       {

            //$this->mailSignup_managers();
            //$this->mailSignup_subscriber();
       }


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


        unset($_POST);

        //echo ' eventSignup '.$queryEv;
    }

    function process_event($event){

        // daca nu are un pretz setat , atunci cauta in events_vars

        if(!$event['ev_price'])
        {
            $query_prices = "SELECT * from events_vars WHERE idEv = {$event['idEv']}";
            $event['prices'] = $this->C->GET_objProperties($this, $query_prices,'',false);


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


        $query_events = "SELECT * from events WHERE idExt = $idM  {$where}  {$exception} ";
        $this->events[$idM] = new stdClass();
        $this->events[$idM]->idM = $idM;
        $this->events[$idM]->listEvents = $this->C->GET_objProperties($this, $query_events,'process_event');

        return "";
    }

    function process_member($member){

        $idM = $member['idM'];

       // $idPers_str = $this->admin ? "aidPers" : "idPers";
        $member['mbr_href'] = !isset($_GET['idPers']) ? "?idc={$this->idC}&idT={$this->idT}&idPers={$idM}" : "#";
        $this->get_events($idM);

        return $member;

    }
    function get_members($idM = '', $processMeth = 'process_member'){

        $where = $idM ? " WHERE idM = $idM" : "";

        $query_members = "SELECT * from members {$where}";
        $this->members = $this->C->GET_objProperties($this, $query_members, $processMeth);

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
 *  $obj->C                     # obiectul principal core
 *
    # situatie core
    $obj->DB     =              # pointer la BD
    $obj->admin  =              # true / false - daca sunt pe admin
    $obj->LG     =              # limba curenta
    $obj->lang   =              # limba curenta
    $obj->nameF  =              # numele de RES al paginii/ categoriei curente in limba curenta
 *                                 ex: name: Categorie Noua = Categorie_noua


    # date ale modu
    $obj->idC    =             # id-ul categoriei curente
    $obj->idT    =             # id-ul parintelui originar
    $obj->level  =             # levelul din tree la care se afla cat
    $obj->type   =             # tipul categoriei curente ex: MODELS / LOCALS


    #date despre acest modul
    $obj->modName =            # numele modulului
    $obj->modType =            # tipul acestuia : GENERAL/ LOCALS /MODELS/ PLUGINS
 *
 *
 *
 * =====[ USABLE DB - methods ]=================================
 *
 *    GET_resultArray ($result, $method = 'fetch_assoc')
 *        * returneaza un array multdimensional cu datele returnate de $result
 *
 *
 *    GET_objProperties(&$obj,$query,$processResMethod='', $onlyArr = false)
 *
 *      *  $obj                              - obiectul care a apelat metoda
        *  $query                            - query-ul de procesat
        *  string $processResMethod($row)    - metoda a $obj care proceseaza orice rand returnat
        *  bool $onlyArr                     - daca queryul ret un singur record
        *                                              false - va seta valoriile ret la obj
        *                                              true - va returna un array[0] = array(colum=>value);
        * return array                     - array muldimensional cu toate recordurile returnate de query
        *                                      si procesate de processResMethod
 *
 *   USE LIKE this
 *      $this->news = $this->C->GET_objProperties($this, $query, 'procesNews');
 *
 *   =>$this->news = array(0=> [title=>'', content=>'', idNews=>'' ], 1=> [], ...);
 *
 *
*/
    /**
     * Apelata imediat dupa instantierea modulului
     * like a second __construct()
     */

    function _setINI(){

        if(isset($_POST['methName']) && $_POST['methName'] == 'eventSignup')
        {
            $this->template_file = 'signup_feedback';
        }
        elseif(isset($this->templates))
        {
            $tmplFile_stat = $this->set_template($this->idC);

            if($tmplFile_stat && method_exists($this, 'get_'.$this->template_file))
            {
                $this->{'get_'.$this->template_file}();

            }

        }

        if (isset($_POST['action'])) $this->setOrderData($_POST['action']);
    }
   /* function DISPLAY(){

        return 'Acesta ar trebui sa fie events';
    }*/

    function __construct(&$C){


    }

}
