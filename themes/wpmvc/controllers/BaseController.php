<?php
require_once ABSPATH . 'wp-content/plugins/mustache/mustache.php';

class BaseController extends N_View {
  var $template;
  var $assigns;

  /*
   * Most controllers will be a subclass of this, so we assign some of
   * the most generic stuff here.
   */
  function __construct(){
    $this->setE('bloginfo_name', 'bloginfo', 'name');
    $this->setE('bloginfo_charset', 'bloginfo', 'charset');
    $this->setE('wp_title');
    $this->setE('template_directory', 'bloginfo', 'template_directory');
    $this->setE('bloginfo_url', 'bloginfo', 'url');
  }
  
  /*
   * Set a template variable by capturing the echo of the named function
   * @param $name - The name of the template variable to set
   * @param $function - The function to call, if none given use $name
   * @param $func_args - any number of arguments accepted by $function
   */
  function setE($name){
    $args = func_get_args();
    $name = array_shift($args);
    if (count($args) == 0) $args = array($name);
    $this->set($name, call_user_func_array('BaseController::e', $args));
  }
  
  /*
   * Set a template variable to a value
   * @param $name - The name of the template variable to set
   * @param $value - The value to set it to
   */
  function set($name, $value){
    $this->assigns[$name] = $value;
  }
  
  /*
   * Call a function and capture any echoed output
   * @param $function - The function to call
   * @param $func_args - any number of arguments accepted by $function
   */
  static function e( $function ){
    $args = func_get_args();
    $fname = array_shift($args);
    ob_start();
    call_user_func_array($fname, $args);
    return ob_get_clean();
  }
}