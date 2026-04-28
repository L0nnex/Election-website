<?php

function myautoload($className) {

    $classname = strtolower($className);
    $classname = str_replace('\\', '/', $classname);
    $classname = __DIR__.'/Library/'.$classname.'.php';

      
    require_once($classname);
}
spl_autoload_register('myautoload');
?>