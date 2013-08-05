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

}