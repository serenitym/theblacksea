<?php
class CblogSite
{
    var $recordsArchive = array(); // articolele scrise de user in partea de archive
    var $recordsBlog  = array(); // articolele scrise de user in partea de blog
    function _hookRow_userData($row)
    {
        $row['editStatus'] = 'not';
        return $row;
    }
    function Set_userData($uid)
    {
        $queryProfile = "
        SELECT
            auth_user_details.uid,
            first_name,
            last_name,
	        CONCAT(first_name, ' ', last_name) AS fullName,
	        title,
	        bio,
	        phone,
	        photo,
	        site,
	        email

	    FROM auth_user_details
	    JOIN auth_users
	    ON (auth_user_details.uid = auth_users.uid)

	    WHERE auth_users.uid = $uid
        ";

        //$this->profile = new stdClass();
        //echo $queryProfile;

        $profile =$this->C->Db_Get_procRows($this, '_hookRow_userData', $queryProfile);
        $this->profile =  (object) $profile[0];
        //var_dump($this->user);

    }
    function Set_profileData()
    {
        $uid = $_GET['uid'];
        $this->Set_userData($uid);

        $blog = new CblogExternal($this);
        $blog->profile_setData($uid);
        $this->recordsArchive = $blog->recordsArchive;
        $this->recordsBlog = $blog->recordsBlog;

        // echo "CblogSite - Set_profileData recordsArchive & recordsBlog";
        // var_dump($this->recordsArchive);
        // var_dump($this->recordsBlog);
    }

    function _hookRow_aboutData($row)
    {
        $row['hrefProfile'] = "?idT={$this->idTree}&idC={$this->idNode}&uid=".$row['uid'];
        return $row;
    }
    function Set_aboutData()
    {
        $queryProfiles = "
        SELECT
            auth_user_details.uid,
	        CONCAT(first_name, ' ', last_name) AS fullName,
	        title,
	        photo

	    FROM auth_user_details
	    JOIN auth_users
	    ON (auth_user_details.uid = auth_users.uid)
        ";
        // WHERE ACTIVE = 1

        $this->profiles =
            $this->C->Db_Get_procRows($this, '_hookRow_aboutData', $queryProfiles);
       // var_dump($this->profiles);
    }

    function _init_()
    {
        $methHandler = $this->template_file;
        $this->{'Set_'.$methHandler.'Data'}();
    }

    function _handle_requests()
    {
        if($_GET['uid']) {
            $this->template_file = "profile";
        } else {
            /**
             * nu poate fi scris in blogSite.yml deoarece cand va ajunge la init
             * template_file va fi rescris
             *
             */
            $this->template_file = "about";
        }
         //echo "CblogSite _handle_requests: template_file {$this->template_file}<br>";

    }
    function __construct($C)
    {
        $this->_handle_requests();
    }
}