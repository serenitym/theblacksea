<?php

class Cevents extends eventRegister
{


    var $members,
        $events,
        $member;

    function get_events($idM = 0, $idEv = ''){

        $where = $idEv ? " AND idEv = $idEv " : "";


        $query_events = "SELECT * from events WHERE idExt = $idM  {$where} ";
        $this->events[$idM] = new stdClass();
        $this->events[$idM]->idM = $idM;
        $this->events[$idM]->listEvents = $this->C->GET_objProperties($this, $query_events);



    }

    function process_member($member){

        $idM = $member['idM'];

        $member['mbr_href'] = $this->admin && !isset($_GET['idPers']) ? "?idc={$this->idC}&idT={$this->idT}&idPers={$idM}" : "#";
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
        if(isset($_GET['idPers']))
        {
            $this->set_template('idPers');
            $this->get_members($_GET['idPers']);
        }
        elseif(isset($_POST['go_signup_ws'])){

            $this->set_template('go_signup_ws');
            $this->get_evMbr($_POST['idM'], $_POST['idEv']);
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



        if(isset($this->templates))
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

    function __construct(&$C){}
}
