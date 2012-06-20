<?php
require_once('BaseController.php');

class HeaderController extends BaseController {
  var $template = 'header';
  
  function __construct(){
    parent::__construct();
  }
}