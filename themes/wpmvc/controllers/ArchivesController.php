<?php
require_once 'ContentController.php';

class ArchivesController extends ContentController {
  var $template = 'archives';
  
  function __construct() {
    $this->set('wp_list_categories', wp_list_categories('echo=0'));
    $this->set('wp_get_archives', wp_get_archives('type=monthly&echo=0'));

    while (have_posts()){
      the_post();
      $this->set('the_content', $this->the_content());
    }
    parent::__construct();
  }   
}
