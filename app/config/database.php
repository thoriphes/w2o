<?php

	define('DB_NAME', 'test');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_HOST', 'localhost');
	define('DB_CONNECTOR', 'mysql');

	Application::$dataManager = new DataManager();
	Application::$dataManager->createManager('default', DB_CONNECTOR, DB_NAME, DB_USER, DB_PASS, DB_HOST);	
?>