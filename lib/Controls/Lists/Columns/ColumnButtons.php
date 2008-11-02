<?php

	class ColumnButtons extends Column
	{
		protected $url;
		
		public function __construct($columnName, $url)
		{
			$this->url = $url;
			$this->id = $columnName;
		}
		
		public function run(&$data = null)
		{
			$id = ($data);
			
			if(!is_array($this->url))
				$this->url = array($this->url);
			
			$buttons = array_keys($this->url);
				
			foreach ($buttons as &$action)
			{
				$tagWrapper = new TagWrapper("a", array(
					'href'	=> $this->url[$action] . $id,
					'title'	=> $action,
					'class'	=> $action
				));
				$tagWrapper->run($action); 
			}
			
			$data = implode(" ", $buttons);
		}
	}

?>