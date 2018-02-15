<?php 
	// Définition des constantes  
	define("DS", DIRECTORY_SEPARATOR);
	define("WEBROOT", dirname(__FILE__));
	define("ROOT", dirname(WEBROOT));
	define("MODEL", ROOT . DS . 'model');
	define("VIEW", ROOT . DS . 'view');
	define("CORE", ROOT . DS . 'core');
	define("IMAGE", WEBROOT . DS . 'img');
	define("CSS_AVATAR", '/myMessenger/webroot/img/avatar/');

	// On inclut les fichiers PHP de base
	require CORE . DS . "include.php";

	

	$request = createRequest();
	includeController($request);
	createAction($request);




		


