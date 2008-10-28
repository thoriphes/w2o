<?php

	class Application
	{
		const DEFAULT_LAYOUT = "main.tpl";
		
		static
			$controller,
			$model,
			$view,
			$layouts = array(),
			$defaultLayout = self::DEFAULT_LAYOUT,
			$css = array(),
			$viewDecorators = array(),
			$dataManager;
			
		public static function init()
		{
			self::bootstrap();
			self::registerRoute();
		}
			
		public static function registerModel($model)
		{
			self::$model = new Model($model);
			$path = realpath(str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__) . "/../../app/models/$model.php"));
			$className = ucwords($model) . "Model";
			if(is_file($path))
			{
				require_once($path);
				self::$model = new $className($model);
			}
		}
		
		public static function registerView($view, $action)
		{
			$path = realpath(str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__) . "/../../app/views/$view/$action.tpl"));
			
			self::$view = new View($view);
			self::$view->setFile($path);
			
			$layout = self::$defaultLayout;
			
			if(isset(self::$layouts[$view][$action]))
				$layout = self::$layouts[$view][$action];
			
			self::$view->setLayout($layout);
			
			foreach(self::$viewDecorators as $event => $decorators)
				foreach($decorators as $decorator)
					self::$view->addDecorator($event, $decorator);
					
			if(count(self::$css[$view][$action])) foreach(self::$css[$view][$action] as $css)
				self::$view->addCSS($css);
		}
		
		public static function registerController($controller, $action)
		{
			$path = realpath(str_replace("/", DIRECTORY_SEPARATOR, dirname(__FILE__) . "/../../app/controllers/$controller.php"));
			if(is_file($path))
			{
				$className = ucwords($controller) . "Controller";
				require_once($path);
				self::$controller = new $className($action);
			}
			else self::$controller = new Controller($action);
			
			if(self::$controller->autoRender)
				self::$controller->render();
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
		
		public static function sanitizePath($path)
		{
			return realpath(str_replace("/", DIRECTORY_SEPARATOR, $path));
		}
		
		protected static function registerRoute()
		{
			self::registerModel(Router::getRoute());
			self::registerView(Router::getRoute(), Router::getAction());
			self::registerController(Router::getRoute(), Router::getAction());
		}
		
		protected static function bootstrap()
		{
			require_once(str_replace("/", DIRECTORY_SEPARATOR, "../config/bootstrap.php"));
		}
	}

?>