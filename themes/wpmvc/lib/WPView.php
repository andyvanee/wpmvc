<?php

require_once('Mustache.php');

class WPView {
  function render( $echo=true ) {
    $template_path = TEMPLATEPATH.'/templates';
    $template = file_get_contents($template_path.'/'.$this->template.'.html');
    $m = new Mustache;
    if ($echo) echo $m->render($template, $this->assigns);
    else       return $m->render($template, $this->assigns);
  }
}
