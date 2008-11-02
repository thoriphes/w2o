<?php

	class Support
	{
		public static function sanitizePath($path)
		{
			return realpath(str_replace("/", DIRECTORY_SEPARATOR, $path));
		}
		
		public static function urlEncode($path)
		{
			return str_replace(" ", "_", str_replace("_", "\_", $path));
		}
		
		public static function urlDecode($path)
		{
			$result = str_replace("\\\\ ", "_", str_replace("_", " ", $path));
			return $result;
		}
		
		public function createLinkURL($controller, $action = "", $params = null)
		{
			if(!is_array($params))
				$params = array($params);
			
			$params = self::cleanParametersArray($params);
				
			foreach($params as &$param)
					$param = self::urlEncode($param);
				
			$items = array();
			$items[] = $controller;
			
			if($action != "")
				$items[] = $action;
				
			$items = array_merge($items, $params);
			$url = implode("/", $items);
			$url = APP_URL . "$url/";
			return $url;
		}
		
		public static function cleanParametersArray(array $params)
		{
			$result = array();
			
			foreach($params as $label => $param)
				if($param != "" && !is_null($param))
					$result[$label] = $param;
			
			return $result;
		}
	}

?>