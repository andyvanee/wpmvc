<?php
require_once 'ContentController.php';

class ArchivesController extends ContentController {
  var $template = 'archives';
  
  function __construct() {
    $this->setE('the_title');
    $this->setE('wp_list_categories');
    $this->setE('wp_get_archives', 'wp_get_archives', 'type=monthly');
    // We should only have one post on the Archives page?
    while (have_posts()){
      the_post();
      $this->setE('the_content');
    }
    parent::__construct();
  }   
}
