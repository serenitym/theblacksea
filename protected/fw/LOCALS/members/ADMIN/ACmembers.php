<?php


class ACmembers extends Cmembers{
/**
 * USABLE - TmethDB - call them from $this->C->methName
 *
 *  reLocate($location='', $ANCORA='',$paramAdd='');
 *
 *  DMLsql($query,$reset=true,$ANCORA='',$location='',$paramAdd='', $errorMessage='')
 *
 *
 *  DMLsql_bulk($queries,$reset=true,$ANCORA='',$location='',$paramAdd='', $errorMessage='')
 *    - run multiple queries
 *
 *
 *  LIKE MAGIC
 *
 *  - _handlePosts_functionName
 *
 *      => daca s-au trimis moduleName & methName
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


    function _handlePosts_methName(){}
    function methName(){}
}