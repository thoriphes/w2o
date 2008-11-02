<?php

	define('APP_URL', 'http://2solteros.dnsalias.com/W2O.MVC/');
	define('APP_NAME', 'My framework test');
	
	Application::addViewDecorator("beforeRender", new TagWrapper('body', array(
		'class' => 'lol',
		'id' => 'paco'
	)));

	Application::addLayout("home", "index", "main.tpl");
	Application::addLayout("articles", "index", "main2.tpl");
	
	Application::addCSS("home", "index", "layout.css");
	Application::addCSS("home", "index", "layout2.css");
	
	require_once(dirname(__FILE__) . "/routes.php");
	require_once(dirname(__FILE__) . "/database.php");
	
?>