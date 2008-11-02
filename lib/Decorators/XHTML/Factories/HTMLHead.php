<?php

	class HTMLHead 
	{
		static $decorators = array();
		
		public static function getXHTML($title = null, $css = null, $js = null, $lang = null, $encoding = null, $description = null)
		{
			self::addDecorator("getXHTML", new TagWrapper("head"));
			
			$title = self::formatTitle($title);
			$css = self::formatCSS($css);
			$js = self::formatJS($js);
			
			$head = $title . $css . $js . MetaEncoding::getXHTML($encoding) . MetaLang::getXHTML($lang) . MetaDescription::getXHTML($description);
			
			return self::fireEvent("getXHTML", $head);
		}
		
		public function formatTitle($title)
		{
			$titleDecorator = new TagWrapper('title');
			return $titleDecorator->run($title);
		}
		
		public function formatCSS($css)
		{
			$cssString = "";
			
			if(!is_array($css))
				$css = array($css);
			
			foreach($css as $file)
				$cssString .= Stylesheet::getXHTML($file);

			return $cssString;
		}
		
		public function formatJS($js)
		{
			$jsString = "";
			
			if(!is_array($js))
				$js = array($js);
			
			foreach($js as $file)
				$jsString .= JSScript::getXHTML($file);

			return $jsString;
		}
		
		public function fireEvent($event, $data = null)
		{
			$result = $data;
			foreach (self::$decorators[$event] as $decorator)
				$result = $decorator->run($result);
			return $result;			
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			self::$decorators[$event][$decorator->getId()] = $decorator;
		}
		
		public function removeDecorator($event, Decorator $decorator) {}
	}

?>