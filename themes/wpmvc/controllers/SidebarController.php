<?php
require_once('BaseController.php');

class SidebarController extends BaseController {
  var $template = 'sidebar';
  
  function __construct(){
    parent::__construct();
    $this->set('search_form', get_search_form($echo=false));

    // There must be a better way. Why must they echo in a boolean check?
    $static_sidebar = false;
    ob_start();
    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar() ) $static_sidebar = true;
    $sidebar = ob_get_clean();
    $this->set('static_sidebar', $static_sidebar);
    $this->set('sidebar', $sidebar);
  }
}
