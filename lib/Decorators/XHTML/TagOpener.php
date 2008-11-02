<?php

	class TagOpener extends TopDataAddition 
	{
		const ID_PREFIX = "addOpenTag_";
		
		static $validProperties = array(
			'id',
			'class',
			'title',
			'src',
			'alt',
			'rel',
			'href',
			'onclick',
			'xml:lang',
			'xmlns'
		);
		
		protected $tagName;
		
		public function __construct($tagName, $properties = null)
		{
			$this->id = self::ID_PREFIX . $tagName;
			$this->setTagName($tagName);
			
			if(is_array($properties))
				$this->setParams($properties);
		}
		
		public function setTagName($tagName)
		{
			$this->tagName = $tagName;
		}
		
		public function generateData($data = null)
		{
			$properties = "";
			if(is_array($this->params)) foreach($this->params as $key => $value)
			{
				$properties .= " $key='".str_replace("'", "&apos;", $value)."'";
			}
			return str_replace(Decorator::DATA_MARKER, $data, "\n<".strtolower($this->tagName).$properties.">\n");
		}
		
		public function setParams(array $params)
		{
			foreach ($params as $key => &$value)
			{
				if(!in_array($key, self::$validProperties))
					unset($params[$key]);
				
				elseif(is_array($value))
					$value = implode(" ", $value);
			}
			
			$this->params = $params;
		}
	}

?>