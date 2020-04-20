<?php
require 'routes.php';
$route = new route;
$route->getRoute($_SERVER['REQUEST_URI']);