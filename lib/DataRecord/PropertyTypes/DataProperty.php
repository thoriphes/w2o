<?php

	abstract class DataProperty
	{
		public $propertyName;
		public $metadata = array();
		
		public function __construct($name, $description = null, $content = null)
		{
			$this->setMeta("name", $name);
			$this->setMeta("description", $description);
			$this->setMeta("content", $content);
		}
		
		public function setMeta($property, $value)
		{
			$this->metadata[$property] = $value;
		}
		
		public function getMeta($property)
		{
			if(isset($this->metadata[$property]))
				return $this->metadata[$property];
		}
		
		public function setPropertyName($name)
		{
			$this->propertyName = $name;
		}
		
		public function getPropertyName()
		{
			return $this->propertyName;
		}
		
		public abstract function in($data);
		public abstract function out($data); 
	}

?>