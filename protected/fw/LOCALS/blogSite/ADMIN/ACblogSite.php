<?php
/**
 * Permissions used:
 *
 *user->rights = array (size=21)
 *
   'gid' => boolean true
   'comm_save'
   'comm_edit'
   'comm_pub'
   'comm_rm'
   'article_edit'   // to edit an article means to : edit / save
   'article_save'   // este destul de pointles pentru ca daca editezi si nu potzi salva nu are nici un sens
   'article_pub'
   'article_rm'
   'mute_user'
   'page_add'
   'page_edit'
   'page_pub'
   'page_rm'
   'user_add'
   'user_edit'
   'user_rm'
   'group_add'
   'group_edit'
   'group_rm'
   'perm_manage'
 *
 * used like :$this->user->rights['article_edit']
 *
 * uclass = [ root, guest, subscriber, moderator, editor,
 *           publisher, webmaster, admin ]
 *
 */

class ACblogSite extends CblogSite
{
    public  $posts; // obiect cu posturile asteptate
    // db methods

    function _hook_saveProfile()
    {
        $validation = true;
        $postExpected = &$this->post_profile;

        $this->posts = handlePosts::Get_postsFlexy($postExpected);
        $posts = &$this->posts;


        $validation &= $this->Get_rightsProfile($posts->uid) ? true :
                       $this->fbk->SetGet_badmessFbk($postExpected['uid']['fbk']);
                     ;

        $validation &= $this->C->emptyValidation(
                         $this,
                         $postExpected,
                        "first_name,last_name,bio"
                      );

        if(!$validation) return false;

        $posts->photo = str_replace(BASE_URL, '', $posts->photo);

        //echo "ACblogSite - _hook_saveProfile: ".BASE_URL."<br>";
        //echo "ACblogSite - _hook_saveProfile: validation = ".($validation ? "true" :  "false")."<br>";
        //var_dump($this->posts);
        //return false;
        return true;
    }
    function saveProfile()
    {
        $query_userDetails = "
            UPDATE auth_user_details
             SET
                first_name = '{$this->posts->first_name}',
                last_name  = '{$this->posts->last_name}',
                title      = '{$this->posts->title}',
                site       = '{$this->posts->site}',
                phone      = '{$this->posts->phone}',
                bio        = '{$this->posts->bio}',
                photo      = '{$this->posts->photo}'
             WHERE
                 uid = {$this->posts->uid}
        ";

        $query_updateUser  = "
            UPDATE auth_users
            SET
              email = '{$this->posts->email}'
            WHERE
                 uid = {$this->posts->uid}
        ";

        //echo "ACblogSite - saveProfile query_userDetails = $query_userDetails <br>";
        //echo "ACblogSite - saveProfile query_updateUser = $query_updateUser <br>";

        $this->DB->query($query_userDetails);
        $this->DB->query($query_updateUser);

        return true;
    }

    // view methods
    function Get_rightsProfile($uid)
    {
        $permision = ( $uid == $this->user->uid
                    || $this->user->uclass == 'admin');
                    //|| $this->user->rights['user_edit'] );

        //echo "ACblogSite - Get_rightsProfile: $uid = {$this->user->uid} <br>";
        /*echo "ACblogSite Get_rightsProfile :"
             .($permision
                ? 'Userul are Permisiuni de editare'
                : 'Userul Nu are Permisiuni de editare')
              ."<br>";*/
        return $permision;
    }
    function _hookRow_userData($row)
    {
       // echo "ACblogSite - _hookRow_profileData  <br>";
        $row['editStatus'] = $this->Get_rightsProfile($row['uid']) ? '' : 'not';
        return $row;
    }
    function _init_()
    {
        //echo "ACblogSite - _init_<br>";

        $this->user = &$this->C->user;
        $this->fbk = &$this->C->feedback;
        parent::_init_();
    }
}