<?php

	class TagWrapper extends Decorator implements Decorated {
		
		const ID_PREFIX = "wrapper_";
		
		protected $decorators = array();
		
		public function __construct($tagName, $properties = null)
		{
			$this->id = self::ID_PREFIX . $tagName;
			$this->addDecorator("run", new TagOpener($tagName, $properties));
			$this->addDecorator("run", new TagCloser($tagName));
		}
		
		public function run(&$data = null)
		{
			return $this->fireEvent("run", $data);
		}
		
		public function fireEvent($event, &$data = null)
		{
			if(count($this->decorators[$event])) 
				foreach($this->decorators[$event] as $decorator)
					$decorator->run($data);	
			return $data;	
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->decorators[$event][$decorator->getId()] = $decorator;
		}
		
		public function removeDecorator($event, Decorator $decorator) {}
		
	}

?>