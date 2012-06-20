<?php
require_once('BaseController.php');

class FooterController extends BaseController {
  var $template = 'footer';
  
  function __construct(){
    $this->setE('sidebar_footer', 'get_sidebar', 'footer');
    $this->setE('wp_footer');
    parent::__construct();
  }
}