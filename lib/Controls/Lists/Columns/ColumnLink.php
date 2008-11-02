<?php

	class ColumnLink extends Column
	{
		protected $url;
		
		public function __construct($columnName, $url)
		{
			$this->url = $url;
			$this->id = $columnName;
		}
		
		public function run(&$data = null)
		{
			$tagWrapper = new TagWrapper("a", array(
				'href'	=> Support::urlEncode($this->url . $data),
				'title'	=> $data
			));
			$tagWrapper->run($data); 
		}
	}

?>