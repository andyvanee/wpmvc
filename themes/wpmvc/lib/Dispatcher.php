<?php

class Dispatcher {
  static function dispatch($controller = null) {
    if (!$controller){
      $c = 'Index';
      $c = is_home()     ? 'Index'   : $c;
      $c = is_singular() ? 'Single'  : $c;
      $c = is_category() ? 'Index'   : $c;
      $c = is_tag()      ? 'Index'   : $c;
      $c = is_author()   ? 'Index'   : $c;
      $controller = $c;
    }
    $controllerClass = "{$controller}Controller";

    require_once TEMPLATEPATH."/controllers/{$controllerClass}.php";
    $controller = new $controllerClass;
    $controller->render();
  }
}
