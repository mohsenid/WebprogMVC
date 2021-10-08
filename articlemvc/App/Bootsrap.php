<?php
    // Load Config
    require_once 'config/config.php';
    
    // require_once 'Libraries/Core.php';
    // require_once "Libraries/Controller.php";
    // require_once "Libraries/Database.php";

    // Load Helpers
    require_once 'helpers/url_helper.php';

    function webprog_mvc($className){
        require_once 'Libraries/' . $className . '.php';
    }
    spl_autoload_register('webprog_mvc');
?>