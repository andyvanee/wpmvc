<?php

require_once('Mustache.php');

class WPView {
  function render() {
    $template_path = TEMPLATEPATH.'/templates';
    $template = file_get_contents($template_path.'/'.$this->template.'.html');
    $m = new Mustache;
    echo $m->render($template, $this->assigns);
  }
}
