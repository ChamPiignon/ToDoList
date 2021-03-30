<?php
    //CHARGEMENT DU FRONT CONTROLLER
    require_once(__DIR__.'/controllers/Router.php');
    //CHARGEMENT DE LA CONFIG
    require_once(__DIR__.'/config/Config.php');
    //chargement autoloader pour autochargement des classes
    require_once(__DIR__.'/config/Autoload.php');
    Autoload::charger();
    $controller = new Router();
?>
