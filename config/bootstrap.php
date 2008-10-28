<?php

	define('APP_DIR', Application::sanitizePath(dirname(__FILE__) . "/../app"));
	define('VIEWS_DIR', APP_DIR . "/views");
	define('LAYOUTS_DIR', VIEWS_DIR . "/layouts");
	define('CSS_URL', 'css/');
	
	Application::addViewDecorator("beforeRender", new TagWrapper('body'));
	Application::addViewDecorator("beforeRender", new HeadAdder());
	Application::addViewDecorator("beforeRender", new TagWrapperHTML("es"));
	Application::addViewDecorator("beforeRender", new WEBFormatterDoctype("xhtml11"));
	
?>