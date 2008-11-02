<?php

	class Application
	{
		const DEFAULT_LAYOUT = "main.tpl";
		
		static
			$layouts = array(),
			$css = array(),
			$viewDecorators = array(),
			$dataManager,
			$currentController,
			$currentAction;
			
		public static function init()
		{
			self::bootstrap();
			self::runController(Router::getRoute(), Router::getAction(), Router::getParams());
		}
			
		public static function runController($controller, $action, $params = null)
		{
			self::$currentController 	= $controller;
			self::$currentAction		= $action;
			
			$path = realpath(str_replace("/", DIRECTORY_SEPARATOR, CONTROLLERS_DIR . "/$controller.php"));
			if(is_file($path))
			{
				$className = ucwords($controller) . "Controller";
				require_once($path);
				$controller = new $className($action, $params);
			}
			else echo "No tengo ese controller, melón!";
			
			if($controller->parameters->autoRender)
				$controller->render();
		}
		
		public static function addLayout($view, $action, $layout)
		{
			self::$layouts[$view][$action] = $layout;
		}
		
		public static function addCSS($view, $action, $css)
		{
			self::$css[$view][$action][] = $css;
		}

		public static function addViewDecorator($event, Decorator $decorator)
		{
			self::$viewDecorators[$event][$decorator->getId()] = $decorator;
		}
		
		protected static function bootstrap()
		{
			require_once(str_replace("/", DIRECTORY_SEPARATOR, "../config/bootstrap.php"));
		}
	}

?>