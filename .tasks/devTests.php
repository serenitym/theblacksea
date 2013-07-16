<?php
class Cblog extends handlers
{
    var $methodHandle ;
    var $assocTmplFile;
    var $tmplFiles;

    //===============================================[ query Filters ]==========

    function Set_subtreeIds($idNode)
    {
        array_push($this->subtreeIds, $idNode);

        if (isset($this->tree[$idNode]->children )
            && count($this->tree[$idNode]->children) > 0
        ) {
            foreach ($this->tree[$idNode]->children AS $idChild) {
                $this->Get_subtreeIds($idChild);
            }
        }
    }
    function Get_categoryFilter()
    {
        /*
         * categoria ar trebui deja sa fie stiuta este $idNode
         * acum ne intereseaza toate recordurile care au idCat IN (listaIduri)
         *
         * listaIduri = categoria curenta + categoriile paritzi si subparinti
         * cu s-ar zice toate nodurile unui subTree sau tree
         * aici mi se pare ca avem nevoie de o functie de ajutor (recursiva )
         * */
        $idNode = $this->idNode;
        $this->Set_subtreeTds($idNode);

        return " idCat IN (".implode(',', $this->subtreeIds).")";

    }
    function _handle_requestFilters($filters = array())
    {
        //filterList
        $filtersStrs = array();

        // check for requested filter
        if (isset($_REQUEST['filterName']) && isset($_REQUEST['filterValue'])) {
           $filters[$_REQUEST['filterName']] =  $_REQUEST['filterValue'];
        }
        // ar trebui sa am un requested filters si ca array

        if (count($filters)) {

            foreach ($filters AS $filterName => $filterValue) {
                //test if method exists
                if (!method_exists($this, 'Get_'.$filterName.'Filter')) {
                    error_log("[ ivy ] Cblog - Get_queryRecords :"
                              ." Sorry the filter $filterName has no method handler "
                    );
                } else {
                    $filter = $this->{'Get_'.$filterName.'Filter'}($filterValue);
                    array_push($filtersStrs, $filter);
                }
            }
        }

        return $filtersStrs;
    }

    function Get_basicFilter()
    {
        $wheres = array();
        if(!$this->editRecords_Permss )
        {
           if (!$this->admin) {
               array_push($wheres, " publishDate is not NULL ");
           } else {
               array_push($wheres, " (uidRec='{$this->uid}' OR publishDate is not NULL) ");

           }
        }

        return  $wheres;
    }


    //===============================================[ query builders ]=========
    function Get_baseQueryRecord()
    {
        /**
         *  blogRecords_view  -- leftOUTER JOIN  (blogRecords cu blogRecords_settings)
         *
         *
         * VIEW blogTagsName_view AS
                 SELECT idRecord, GROUP_CONCAT( tagName SEPARATOR  ', ' ) AS tagsName
               FROM blogTags
                   JOIN blogMap_recordsTags
                   ON ( blogTags.idTag = blogMap_recordsTags.idTag )
               GROUP BY idRecord
         *
         * -- ATENTIE -- Nu sunt sigura ca este cea mai eficienta metoda cu acest view  (dar mom pare cea mai simpla)
         *
        */

         $query = "SELECT
                            blogRecords_view.idRecord,
                            idCat,uidRec,entryDate,publishDate,nrRates,ratingTotal,
                            title,content,lead,
                            modelBlog_name,modelComm_name,commentsView,commentsStat,commentsApprov,SEO,
                            {$this->modelBlog_vars_ColsStr}

                            uid_Rec, fullName,

                            tagsName

                             FROM blogRecords_view
                             JOIN
                              (
                                 SELECT uid AS uid_Rec, CONCAT(first_name,'  ',last_name) AS fullName
                                 from auth_user_details

                              ) AS TBuserName
                              ON (blogRecords_view.uidRec = TBuserName.uid_Rec)

                              LEFT OUTER JOIN
                              (
                                SELECT idRecord, GROUP_CONCAT( tagName SEPARATOR  ', ' ) AS tagsName
                              		FROM blogMap_recordsTags
                              		GROUP BY idRecord
                              )AS TBtagsName
                              ON (blogRecords_view.idRecord = TBtagsName.idRecord)

                                           ";

         return $query;

    }

    function Get_baseQueryRecords()
    {

        $query = "SELECT
                    blogRecords_view.idRecord,
                    idCat,uidRec,entryDate,publishDate,nrRates,ratingTotal,
                    title,content,lead,
                    modelBlog_name,modelComm_name,commentsView,commentsStat,commentsApprov,SEO,

                    uid_Rec, fullName,

                    tagsName

                    FROM blogRecords_view
                         JOIN
                         (
                           SELECT uid AS uid_Rec, CONCAT(first_name,'  ',last_name) AS fullName
                           FROM auth_user_details
                         ) AS TBuserName
                         ON (blogRecords_view.uidRec = TBuserName.uid_Rec)

                         LEFT OUTER JOIN
                         (
                           SELECT idRecord, GROUP_CONCAT( tagName SEPARATOR  ', ' ) AS tagsName
                                FROM blogMap_recordsTags
                                GROUP BY idRecord
                         ) AS TBtagsName
                          ON (blogRecords_view.idRecord = TBtagsName.idRecord)

                          ";


     return $query;

    }
    /**
     * @param        $filters  = array($filterName => $filterValue);
     *
     * @return array
     */
    function Get_queryRecords($filters)
    {
         $sql = new stdClass();
        //$sql->parts['query'];
        //$sql->fullQuery;


        $sql->parts['query']  = $this->Get_baseQueryRecords(); // return string
        $basicFilters         = $this->Get_basicFilter();  //return array
        $requestFilters       = $this->_handle_requestFilters($filters);

        $sql->parts['wheres'] = array_merge($basicFilters, $requestFilters);
        $sql->fullQuery       = $sql->parts['query'].
                                 (count($sql->parts['wheres']) == 0
                                  ? ''
                                  : ' WHERE '.implode(' AND ', $sql->parts['wheres'])
                                 );

        error_log("[ ivy ] Cblog - Get_queryRecords : {$sql->fullQuery}");

        return $sql;
    }

    function Get_queryRecord()
    {
        $sql = new stdClass();
        //$sql->parts['query'];
        //$sql->fullQuery;

        $sql->parts['query'] = $this->Get_baseQueryRecord();
        $sql->parts['where'] = " WHERE blogRecords_view.idRecord = '{$_GET['idRec']}'" ;

        $sql->fullQuery = implode(' ', $sql->parts);
        error_log("[ ivy ] Cblog - Get_queryRecords : {$sql->fullQuery}");

        return $sql;

    }


    function _init_()
    {
        $this->_handle_requests();

        #===============================================================================================================
        if (!isset($this->uid)) {
            error_log('[ ivy ] Cblog - _init_ : Nici un user nu a fost setat ');
        }


    }




    function __construct($C){  }
}