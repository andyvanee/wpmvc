<?php
require_once('ContentController.php');

class SingleController extends ContentController {
  var $template = 'index';
  
  function __construct(){
    parent::__construct();
  }
  function perPost(&$post){
    $post['tags'] = BaseController::e('the_tags', '', ', ', '<br>');
    $post['edit_post_link'] =  BaseController::e('edit_post_link', 'Edit', '', ' &bull; '); 
    $post['comments_popup_link'] = BaseController::e('comments_popup_link', 'Respond to this post &raquo;', '1 Response &raquo;', '% Responses &raquo;');
  }
}