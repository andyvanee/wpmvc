<?php

require_once('controllers/FooterController.php');

$controller = new FooterController;
$controller->render();
unset($controller);