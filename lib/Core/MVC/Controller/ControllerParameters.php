<?php

	class ControllerParameters
	{
		public 
			$layoutFile 	= Application::DEFAULT_LAYOUT,
			$css 			= array(),
			$autoRender 	= true,
			$pageSize 		= 10;
			
		public function setProperty($property, $value)
		{
			$this->$property = $value;
		}
		
		public function getProperty($property)
		{
			return $this->$property;
		}
	}

?>