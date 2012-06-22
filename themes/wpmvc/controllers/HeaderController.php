<?php
require_once 'BaseController.php';

class HeaderController extends BaseController {
  var $template = 'header';
  
  function __construct(){
    $this->setE('stylesheet_url', 'bloginfo', 'stylesheet_url');
    $this->setE('language_attributes', 'language_attributes');
    $this->setE('bloginfo_html_type', 'bloginfo', 'html_type');
    $this->setE('bloginfo_description', 'bloginfo', 'description');
    $this->setE('bloginfo_rss_url', 'bloginfo', 'rss_url');
    $this->setE('bloginfo_atom_url', 'bloginfo', 'atom_url');
    $this->setE('bloginfo_rss2_url', 'bloginfo', 'rss2_url');
    $this->setE('bloginfo_pingback_url', 'bloginfo', 'pingback_url');
    $this->setE('wp_enqueue_jquery', 'wp_enqueue_script', 'jquery');
    $this->setE('wp_head');
    $this->setE('body_class');
    $this->setE('wp_list_pages', 'wp_list_pages', 'title_li=');
    parent::__construct();
  }
}