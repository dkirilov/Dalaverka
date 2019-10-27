<?php

	 // Are we in dev mode?
	 define('DEV_MODE', true);
	 
	 // Determining whether it is SSL connection or not
     define('IS_HTTPS',  (empty($_SERVER['HTTPS'])?0:1));
	 define('HTTP_PROTOCOL', (IS_HTTPS?'https':'http'));

     // Setting up some base dir paths
	 define('DS', DIRECTORY_SEPARATOR);
     define('BASE_DIR', __DIR__ . DS);
     define('FILES_DIR', BASE_DIR . DS . 'files' . DS);
	 define('TEMPLATES_DIR', BASE_DIR . DS . 'templates' . DS);
	 define('WIDGETS_DIR', BASE_DIR . DS . 'widgets' . DS);
	 define('SYSTEM_TEMPLATES_DIR', TEMPLATES_DIR . 'system' . DS);

     // Setting up some base URLs
	 define('BASE_URL', HTTP_PROTOCOL . '://' . str_replace($_SERVER['DOCUMENT_ROOT'], $_SERVER['HTTP_HOST'], BASE_DIR));
	 define('FILES_DIR_URL',  BASE_URL .  '/files/');
	 define('TEMPLATES_DIR_URL',   BASE_URL .  '/templates/');
	 define('WIDGETS_DIR_URL',   BASE_URL .  '/widgets/');
	

     // Other useful basic settings
	 define('DEFAULT_LANG', 'bg');
	 define('DEFAULT_CHARSET', 'UTF-8');
	 define('DEFAULT_TEMPLATE', 'Dalaverka');	 
	 define('DEFAULT_PAGE', 'home');
	 
	 define('SITE_NAME', 'Dalaverka');

	 
	 $LANG = array();
?>