<?php

class CsitePrez{
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


    function save_festDetails(){

        $this->resPath = $this->C->get_resPath_forObj($this, 'festDetails');

        file_put_contents($this->resPath, trim($_POST['details_en']));

    }

    function get_members(){

        $query_members = "SELECT * from members";
        $this->members = $this->C->GET_objProperties($this, $query_members);

    }
    function _setINI(){

        $this->get_members();
        $this->C->SET_general_mod('gallery','MODELS');

    }


    function __construct(&$C){}
}