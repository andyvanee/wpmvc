<?php

require_once('controllers/PageController.php');

$controller = new PageController;
$controller->render();
unset($controller);