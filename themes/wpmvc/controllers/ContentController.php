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

        $content = get_the_content();
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        $post['content'] = $content;

        $post['link_pages'] = wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'echo'=>0));

        // Get the categories and links to them and set the delimiter between
        $categories = get_the_category();
        foreach ($categories as &$cat){
          $cat->delim = ', ';
          $cat->href = get_category_link( $cat->term_id );
        }
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