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
		
		public function generateData()
		{
			return "\n</".strtolower($this->tagName).">\n";
		}
		
	}
?>