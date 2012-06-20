<?php

require_once('controllers/HeaderController.php');

$controller = new HeaderController;
$controller->render();
unset($controller);