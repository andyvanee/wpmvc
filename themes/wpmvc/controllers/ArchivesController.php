<?php
require_once 'BaseController.php';

class ArchivesController extends BaseController {
  var $template = 'archives';
  
  function __construct() {
    $this->setE('the_title');
    $this->setE('wp_list_categories');
    $this->setE('wp_get_archives', 'wp_get_archives', 'type=monthly');
    $this->setE('get_header');
    $this->setE('get_footer');
    $this->setE('get_sidebar');
    // We should only have one post on the Archives page?
    while (have_posts()){
      the_post();
      $this->setE('the_content');
    }
  }   
}
