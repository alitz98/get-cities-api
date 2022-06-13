<?php

include "App/iran.php";
require __DIR__ . '/vendor/autoload.php';

define('CACHE_DIR',__DIR__ ."/Cache");
define('JWT_KEY','7LearnIranKey78dfndfj*d7*dHH');
define('JWT_ALG','HS256');



spl_autoload_register(function($class){

    $file_path=__DIR__ ."/" . $class.".php";
    include $file_path;
});

