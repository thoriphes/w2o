<?php
	
	Application::addViewDecorator("beforeRender", new TagWrapper('body', array(
		'class' => 'lol'
	)));

	Application::addLayout("home", "index", "main2.tpl");
	Application::addCSS("home", "index", "layout.css");
	Application::addCSS("articles", "index", "layout.css");
	Application::addCSS("articles", "index", "tables.css");
	require_once(dirname(__FILE__) . "/routes.php");
	require_once(dirname(__FILE__) . "/database.php");
	
?>