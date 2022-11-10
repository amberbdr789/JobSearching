<?php
    require_once 'config.php';
    //autoloader

    spl_autoload_register(function ($class) {
        require_once 'lib/'.$class.'.php';
    });
?>

