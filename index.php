<?php

require_once './controller/ControllerPlayer.php';

$url = parse_url($_SERVER['REQUEST_URI']);

$path = $url['path'] ?? '/';

switch($path){
    case $path === "/" :
        echo (new ControllerPlayer())->render();
        break;
    default:
        echo "Page not found";
        break;
}


