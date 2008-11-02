<?php

	class TagCloser extends BottomDataAddition 
	{
		const ID_PREFIX = "addCloseTag_";
		
		protected $tagName;
		
		public function __construct($tagName)
		{
			$this->id = self::ID_PREFIX . $tagName;
			$this->setTagName($tagName);
		}
		
		public function setTagName($tagName)
		{
			$this->tagName = $tagName;
		}
		
		public function generateData($data = null)
		{
			return str_replace(Decorator::DATA_MARKER, $data, "\n</".strtolower($this->tagName).">\n");
		}
		
	}
?>