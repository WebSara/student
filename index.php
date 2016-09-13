<?php

//set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/Controllers') . PATH_SEPARATOR . realpath(__DIR__ . '/Models') . PATH_SEPARATOR . realpath(__DIR__ . '/Views'));

//includer class path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    realpath(__DIR__),
)));

function __autoLoadClass($classname)
{

    if (class_exists($classname, false) || interface_exists($classname, false))
    {
        return;
    }

    
    $class = str_replace('_', '/', $classname) . ".php";

    $fileClass = __DIR__ . $class;

    if (file_exists($fileClass) && is_readable($fileClass))
    {
        require_once($classname . '.php');
        return true;
    }
    return false;
}
spl_autoload_register('__autoLoadClass');
require_once 'Models/Application.php';
//start app
$application = new Application();

$application->start();