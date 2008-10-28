<?php

	class Router
	{
		const DEFAULT_ROUTE = "home";
		const DEFAULT_ACTION = "index";
		
		static $routes = array();
		
		public static function getAll()
		{
			$route  = $_SERVER['PATH_INFO'];
			
			if(isset($_GET['url']))
				$route = $_GET['url'];
			
			$params = self::cleanArray(explode("/", $route));
			return $params;
		}
		
		public function add($name)
		{
			self::$routes[$name] = new Route($name);
		}
		
		public static function getRoute()
		{
			$params = self::getAll();
			
			if(!isset($params[0]))
				return self::DEFAULT_ROUTE;
			
			if(isset(self::$routes[$params[0]]))
				return self::$routes[$params[0]]->getName();
				
			return $params[0];
		}
		
		public static function getAction()
		{
			$params = self::getAll();
			
			if(!isset($params[1]))
				return self::DEFAULT_ACTION;
			return $params[1];
		} 
		
		public static function getParams()
		{
			$params = self::getAll();
			unset($params[0]);
			unset($params[1]);
			return array_values($params);		
		}
		
		private static function cleanArray(array $array)
		{
			foreach($array as $key => $param)
				if($param == '') unset($array[$key]);
			return array_values($array); 		
		}
		
	}

?>