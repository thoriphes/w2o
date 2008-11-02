<?php

	define('APP_DIR', 			Support::sanitizePath(dirname(__FILE__) . "/../app"));
	define('VIEWS_DIR', 		APP_DIR . "/views");
	define('MODELS_DIR', 		APP_DIR . "/models");
	define('CONTROLLERS_DIR', 	APP_DIR . "/controllers");
	define('DATARECORDS_DIR', 	APP_DIR . "/datarecords");
	define('LAYOUTS_DIR', 		VIEWS_DIR . "/layouts");
	define('CSS_URL', 			'css/');
	
	Application::addViewDecorator("beforeRender", new TagWrapper('body'));
	Application::addViewDecorator("beforeRender", new HeadAdder());
	Application::addViewDecorator("beforeRender", new TagWrapperHTML("es"));
	Application::addViewDecorator("beforeRender", new WEBFormatterDoctype("xhtml11"));
	
?>