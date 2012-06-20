<?php

require_once('controllers/IndexController.php');

$controller = new IndexController;
$controller->render();
unset($controller);