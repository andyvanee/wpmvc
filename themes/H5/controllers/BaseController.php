<?php
class BaseController extends N_View {
  var $template;
  var $view_assigns;

  function __construct(){
    $this->setE('header', 'get_header');
    $this->setE('sidebar', 'get_sidebar');
    $this->setE('footer', 'get_footer');
    
    $posts = array();
    
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        $post = array();
        $post['id']               = BaseController::e('the_ID');
        $post['permalink']        = BaseController::e('the_permalink');
        $post['title_attribute']  = BaseController::e('the_title_attribute');
        $post['title']            = BaseController::e('the_title');
        $post['date']             = BaseController::e('the_time', 'F jS, Y');
        $post['author']           = BaseController::e('the_author');
        $post['content']          = BaseController::e('the_content', '');
        $post['link_pages'] = BaseController::e('wp_link_pages', array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
        $posts[] = $post;
      }
    }
    $this->set('posts', $posts);
  }
  
  /*
   * Set a template variable by capturing the echo of the named function
   * @param $name - The name of the template variable to set
   * @param $function - The function to call
   * @param $func_args - any number of arguments accepted by $function
   */
  function setE($name, $function){
    $args = func_get_args();
    $name = array_shift($args);
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