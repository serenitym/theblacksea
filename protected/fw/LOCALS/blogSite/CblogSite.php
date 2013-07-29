<?php
class CblogSite
{
    function Set_profileData()
    {
        $uid = $_GET['uid'];
        $queryProfile = "
        SELECT
            auth_user_details.uid,
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
        $this->profile = new stdClass();
        //echo $queryProfile;
       $this->C->Db_Set_modProps($this->profile, $queryProfile);

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

        $this->profiles =
            $this->C->Db_Get_procRows($this, '_hookRow_aboutData', $queryProfiles);
       // var_dump($this->profiles);
    }
    function _init_()
    {
        if($_GET['uid']) {
            $this->template_file = "profile";
        }

        $methHandler = $this->template_file;
        $this->{'Set_'.$methHandler.'Data'}();
    }
}