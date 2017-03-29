<?php
header('Content-Type: text/html; charset: utf-8');
require_once 'application/FrontController.php';
set_include_path(get_include_path() .PATH_SEPARATOR .'application/controllers'
                                    .PATH_SEPARATOR .'application/models'
                                    .PATH_SEPARATOR .'application/views'
                                    .PATH_SEPARATOR .'application/core');

function myAutoload($class){
    include_once $class.'.php';
}
spl_autoload_register('myAutoload');
$a=FrontController::getInstance();
$a->run();
