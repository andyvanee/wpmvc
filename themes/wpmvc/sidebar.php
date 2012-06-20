<?php

require_once('controllers/SidebarController.php');

$controller = new SidebarController;
$controller->render();
unset($controller);