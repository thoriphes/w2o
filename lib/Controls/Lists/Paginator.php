<?php

	class Paginator implements Decorated
	{
		const PAGE_SEPARATOR = " ";
		
		protected 
			$totalRegisters,
			$pageSize,
			$currentPage,
			$totalPages;
		
		protected $decorators = array();
		
		public function __construct($pageSize, $totalRegisters, $currentPage = null)
		{
			$this->totalRegisters 	= $totalRegisters;
			$this->pageSize 		= $pageSize;
			$this->currentPage		= $currentPage;
			$this->totalPages 		= ceil($this->totalRegisters/$this->pageSize);
			$this->initDecorators();
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->decorators[$event][$decorator->getId()] = $decorator;
		}
		
		public function removeDecorator($event, Decorator $decorator)
		{
			unset($this->decorators[$event][$decorator->getId()]);
		}
		
		public function clearDecorators()
		{
			$this->decorators = array();
		}
		
		public function fireEvent($event, &$data = null)
		{
			if(count($this->decorators[$event]))
				foreach($this->decorators[$event] as $decorator)
				{
					$decorator->run($data);
				}
		}
		
		protected function generatePages()
		{
			$result = array();
			for($page = 1; $page <= $this->totalPages; $page++)
			{
				$pageNumber = $page;
				$this->fireEvent("createPage", $pageNumber);
				$result[] = $pageNumber;
			}
			return $result;
		}
		
		protected function initDecorators()
		{
			$this->addDecorator("createPage", new TagWrapper("a", array(
				'href' 	=> Support::createLinkURL(Application::$currentController, Application::$currentAction) . Decorator::DATA_MARKER,
				'title'	=> ucwords(Application::$currentController . " " . Application::$currentAction) . " page " . Decorator::DATA_MARKER
			)));
			$this->addDecorator("createPage", new TagWrapper("li"));
			$this->addDecorator("render", new TagWrapper("ul"));
		}
		
		public function render()
		{
			if($this->totalPages > 1)
			{
				$result = implode(self::PAGE_SEPARATOR, $this->generatePages());
				$this->fireEvent("render", $result);
				return $result;
			}
		}
	}

?>