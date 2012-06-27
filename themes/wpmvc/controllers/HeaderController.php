<?php
require_once 'BaseController.php';

class HeaderController extends BaseController {
  var $template = 'header';
  
  function __construct(){
    $this->setE('language_attributes', 'language_attributes');

    $bloginfo_fields = array(
      'description' ,
      'atom_url'    ,
      'rss2_url'    ,
      'pingback_url',
      'charset'     ,
      'html_type'
    );
    
    foreach ($bloginfo_fields as $f) {
      $this->set('bloginfo_'.$f, get_bloginfo($f, 'display'));
    }

    $this->set('wp_head', wp_head('echo=0'));
    $this->set('body_class', join(' ', get_body_class()));
    $this->set('wp_list_pages', wp_list_pages('echo=0&title_li='));

    parent::__construct();
  }
}