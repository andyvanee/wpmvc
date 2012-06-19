<?php
require_once('BaseController.php');

class PageController extends BaseController {
  var $template = 'page.mustache';
  
  function __construct(){
    parent::__construct();
  }
}