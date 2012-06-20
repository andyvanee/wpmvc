<?php
require_once 'BaseController.php';

class ContentController extends BaseController {
  function __construct() {
    $this->setE('header', 'get_header');
    $this->setE('sidebar', 'get_sidebar');
    $this->setE('footer', 'get_footer');
    $this->postLoop();
  }

  /*
   * Loop through the available posts and assign content
   */
  function postLoop(){
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
        $this->perPost(&$post);
        $posts[] = $post;
      }
    }
    $this->set('posts', $posts);
  }

  /*
   * A hook for subclasses to assign to each post in the loop
   */
  function perPost(&$post){ }
}