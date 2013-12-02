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
    var $contentRights = 'no';
    var $post;
    var $user;

    function _hook_save_descPage()
    {
        if($this->contentRights) {
            $this->C->feedBack->Set_mess(
                'error',
                'Permission error',
                'You dont have permissions to edit this page'
            );
            return false;
        }

        $this->post->resName  = $_POST['BLOCK_id'].'Description';
        $this->post->pathName = $this->C->Module_Get_pathRes($this,
                                $this->post->resName);
        $this->post->desc = $_POST['desc'];

        //error_log("********* [ ivy ] _hook_save_descPage");
        //var_dump($this->post);
        return true;
    }
    function save_descPage()
    {
        var_dump($this->post);
        Toolbox::Fs_writeTo($this->post->pathName, $this->post->desc);
        //file_put_contents($this->post->pathName, $this->post->desc);

        //return false;
        return true;
    }

    function set_contentRights()
    {
        if($this->user->cid <= 2) {

            $this->contentRights = '';
        }
    }

    function _init_()
    {
        $this->user = &$this->C->user;
        $this->set_contentRights();
    }
}