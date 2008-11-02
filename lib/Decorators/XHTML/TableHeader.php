<?php

	class TableHeader extends TopDataAddition implements Decorated
	{
		const ID = "addTableHeader";
		
		public function __construct(&$titles)
		{
			$this->id = self::ID;
			$this->setParams(&$titles);
			$this->addDecorator("run", new Imploder());
			$this->addDecorator("run", new TagWrapper("tr"));
			$this->addDecorator("run", new TagWrapper("thead"));
			$this->addDecorator("createTH", new TagWrapper("th", array(
				'class' => Decorator::DATA_MARKER
			)));
		}
		
		protected function generateData($data = null)
		{			
			foreach($this->params as &$title)
				$this->fireEvent("createTH", $title);

			$this->fireEvent("run", $this->params);
			
			return $this->params;
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