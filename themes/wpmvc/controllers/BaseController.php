<?php

require_once ABSPATH.'/wp-content/themes/wpmvc/lib/WPView.php';

class BaseController extends WPView {
  var $template;
  var $assigns;

  /*
   * Most controllers will be a subclass of this, so we assign some of
   * the most generic stuff here.
   */
  function __construct(){
    $this->set('template_directory', get_bloginfo('template_directory', 'display'));
    $bloginfo_fields = array('name', 'url');
    foreach ( $bloginfo_fields as $f ){
      $this->set("bloginfo_{$f}", get_bloginfo($f, 'display'));
    }
    $this->set('wp_title', wp_title($sep = '', $display = false, $seplocation = ''));
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
   * Duplicate but non-echoing version of the_content
   */
  function the_content($more_link_text = null, $stripteaser = false){
    $content = get_the_content($more_link_text, $stripteaser);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
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
