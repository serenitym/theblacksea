<?php


class ACevents extends Cevents{
/**
 * USABLE - TmethDB - call them from $this->C->methName
 *
 *  reLocate($location='', $ANCORA='',$paramAdd='');
 *
 *  DMLsql($query,$reset=true,$ANCORA='',$location='',$paramAdd='', $errorMessage='')
 *
 *
 *  Db_queryBulk($queries,$reset=true,$ANCORA='',$location='',$paramAdd='', $errorMessage='')
 *    - run multiple queries
 *
 *
 *  LIKE MAGIC
 *
 *  - _handlePosts_functionName
 *
 *      => daca s-au trimis modName & methName
 *      => core va incerca sa apeleze aceasta metoda intai apoi functionName
 *          daca _handlePosts_ returneaza true
 *
 *      - utilizare
 *          - functia va standardiza / valida datele venite prin post
 *          - va seta errori si warninguri
 *          - daca datele sunt invalide va returna false , altfel true
 *
 *  *** [ SEE ] core->ctrl_postRequest()
 *
*/


    function get_events($idM = 0, $idEv = '', $exception = " AND idEv != 6 " ){

        // i dont realy like this
        parent::get_events($idM, $idEv, $exception);

        if(count($this->events[$idM]->listEvents) == 0)
        {
            $this->events[$idM]->listEvents[0] = array();
            $this->events[$idM]->listEvents[0]['style'] = 'display: none;';
            $this->events[$idM]->listEvents[0]['idEv'] = "new{$idM}";
        }
    }


    /*=============[ process requests ]=============================*/

    // exemples
    function _hook_methName(){}
    function methName(){}

    // members
    function addMember(){

        $query = "INSERT into members ( mbr_name ) values ( '{$_POST['mbr_name']}' ) ";
        $this->DB->query($query);
        $idM = $this->DB->insert_id;

        $this->C->reLocate('','',"&idPers={$idM}");
    }
    function saveMember(){

        $idM             = $_POST['BLOCK_id'];

        $mbr_picUrl      = $this->C->set_imgRelativePath($_POST['mbr_picUrl_'.$this->lang]);
        $mbr_name        = trim($_POST['mbr_name_'.$this->lang]);
        $mbr_description = trim($_POST['mbr_description_'.$this->lang]);

        $query = "UPDATE members SET
                    mbr_picUrl      =  '{$mbr_picUrl}',
                    mbr_name        =  '{$mbr_name}',
                    mbr_description =  '{$mbr_description}'

                    WHERE idM = $idM
                    ";

        //echo "saveMember = ".$query."<br>";
        $this->DB->query($query);


    }
    function deleteMember(){

        $idM = $_POST['BLOCK_id'];
        $queries = array();
        array_push($queries,"DELETE from members WHERE idM = $idM ");
        array_push($queries,"DELETE from events WHERE idExt = $idM ");

        $this->C->Db_queryBulk($queries);

    }

    // events

    function manage_varPrices(){

        if(isset($_POST['var_prices_'.$this->lang])){


           // $_POST['prices'] = 'priceName1 = 30, priceName2 = 60 '

           $pricesStr = $_POST['var_prices_'.$this->lang];

           $pricesArr = explode(',',$pricesStr);
           $prices = array();
           foreach($pricesArr AS $priceVar){

               $priceVar = explode('=', $priceVar );
               array_push($prices,
                           "ev_nameVar = '".trim($priceVar[0])."' , ".
                           "ev_price = ". intval( trim($priceVar[1]) )  );
           }

           $_POST['prices'] = $prices;

       }


    }

    function _hook_saveEvent(){

        $_POST['ev_name_en'] = htmlspecialchars($_POST['ev_name_en']);

        $this->manage_varPrices();

        return true;
    }
    function _hook_addEvent(){

        $_POST['ev_name_en'] = htmlspecialchars($_POST['ev_name_en']);

        $this->manage_varPrices();

        return true;
    }
    function addEvent(){

        // processPosts( $expectedPosts, $notEmpty = true, $validation = true)


        $psts = $this->C->processPosts($this->events_posts, true, false);

        $setValues = $this->C->Db_setValsFromArr( $psts->vars);

        $query = "INSERT into events SET $setValues ";

        //echo "addEvent - $query <br>";

        $this->DB->query($query);


        if(isset($_POST['var_prices_'.$this->lang]) && isset($_POST['prices'])){

            $idEv = $this->DB->insert_id;
            $queries = array();
            foreach($_POST['prices'] AS $priceQuery)
                array_push($queries, "INSERT into events_vars SET {$priceQuery} , idEv = $idEv ");

             $this->C->Db_queryBulk($queries);
        }

    }
    function saveEvent(){

        $idEv =  $_POST['BLOCK_id'] ;

        $psts = $this->C->processPosts($this->events_posts, true, false);

        $setValues = $this->C->Db_setValsFromArr( $psts->vars);

        $query = "UPDATE events SET $setValues  WHERE idEv = $idEv ";

        //echo "addEvent - $query <br>";

        $this->DB->query($query);



        // daca avem preturi optionale pentru eventuri
        if(isset($_POST['var_prices_'.$this->lang]) && isset($_POST['prices'])){

            // delete all pricing vars for an event
            $query_delete = "DELETE from events_vars WHERE idEv = $idEv ";
            $this->DB->query($query_delete);

            // and then insert new ones
            $queries = array();
            foreach($_POST['prices'] AS $priceQuery)
                array_push($queries, "INSERT into events_vars SET {$priceQuery} , idEv = $idEv ");

             $this->C->Db_queryBulk($queries);

            //echo "delete events_vars {$query_delete} <br>";
            //var_dump($queries);
        }



    }
    function deleteEvent(){

        $query = "DELETE from events WHERE idEv = {$_POST['BLOCK_id']} ";
        $this->DB->query($query);

    }




}