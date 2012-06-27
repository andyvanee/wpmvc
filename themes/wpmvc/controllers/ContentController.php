<?php
require_once 'BaseController.php';
require_once 'HeaderController.php';
require_once 'FooterController.php';
require_once 'SidebarController.php';

class ContentController extends BaseController {
  function __construct() {
    $header  = new HeaderController;
    $sidebar = new SidebarController;
    $footer  = new FooterController;
    $this->set('header', $header->render(false));
    $this->set('sidebar', $sidebar->render(false));
    $this->set('footer', $footer->render(false));
    $this->postLoop();
    parent::__construct();
  }

  /*
   * Here we run the loop and assign content for the template
   * See perPost() if you want to hook into the loop in subclasses
   */
  function postLoop(){
    $posts = array();
    if (have_posts()) {
      while (have_posts()) {
        the_post(); // Delete this to make the server eat itself
        $post = array();
        $post['id']               = get_the_ID();
        $post['permalink']        = get_permalink();
        $post['title']            = get_the_title();
        $post['date']             = get_the_time('F jS, Y');
        $post['author']           = get_the_author();

        $post['content'] = $this->the_content();

        $post['link_pages'] = wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'echo'=>0));

        // Get the categories and links to them and set the delimiter between
        $categories = array_map(function(&$cat){
          $cat->delim = ', ';
          $cat->href = get_category_link( $cat->term_id );
        }, get_the_category());

        // Unset the final delimiter
        end($categories)->delim = '';
        $post['category'] = $categories;

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