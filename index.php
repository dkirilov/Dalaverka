<?php

require_once("config.php");
require_once("functions.php");

spl_autoload_register(function ($class) {
       if(php_uname('s') !== 'Windows'){
       	   $class = str_replace('\\', '/', $class);
       }

       $fext = "";
       if(strpos($class, "interface") !== false){
       		$fext .= '.interface.php';
       }else{
       		$fext .= '.class.php';
       }

      if(file_exists(WIDGETS_DIR . DEFAULT_TEMPLATE . DS . $class . DS . $class . $fext)){
         include_once(WIDGETS_DIR . DEFAULT_TEMPLATE . DS . $class . DS . $class . $fext);
      }else{
         include_once(BASE_DIR . 'classes' . DS . $class . $fext);
      }
});

ini_set('display_errors',  DEV_MODE);
ini_set('display_startup_errors', DEV_MODE);
error_reporting(DEV_MODE?E_ALL:E_USER);

set_exception_handler('custom_exception_handler');

$request_path = isset($_GET['path'])?$_GET['path']:'';

$dispatcher = new \core\Dispatcher(DEFAULT_TEMPLATE, DEFAULT_LANG, $request_path);
$dispatcher->run();

?>