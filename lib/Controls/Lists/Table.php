<?php

	class Table implements Decorated 
	{

		private 
			$rowAlternator = array('odd', 'even'),
			$alternator,
			$alternatorCount = 0,
			$currentId,
			$columns = array();
		
		
			
		public function __construct()
		{
			$this->addDecorator("render", new Imploder("\n"));
			$this->addDecorator("render", new TagWrapper("tbody"));
			$this->addDecorator("render", new TableHeader(&$this->columns));
			$this->addDecorator("render", new TagWrapper("table"));
			$this->addDecorator("createRow", new Imploder("\n"));
			$this->addDecorator("createRow", new TagWrapper("tr", array(
				'class' => &$this->alternator,
				'id' 	=> &$this->currentId
			)));
		}
		
		public function addColumn(Column $column, $title = null)
		{
			$columnName = $column->getId();
			
			if(is_null($title))
				$title = $columnName;
				
			$this->columns[$columnName] = $title;
			$this->addDecorator("format{$columnName}", $column);
			$this->addDecorator("format{$columnName}", new TagWrapper("td", array(
				'class' => $columnName
			)));
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
					$decorator->run($data);
		}
		
		public function render(array $data)
		{
			$this->decorators["render"][TableHeader::ID]->setParams($this->columns);
			
			foreach($data as &$row)
				$this->createRow($row);
			
			$this->fireEvent("render", $data);
			
			return $data;
		}
		
		public function createRow(array &$row)
		{
			$this->alternate();
			$this->currentId = Application::$currentController . $row['id'];
			
			$row = array_intersect_key($row, $this->columns);
			
			foreach(array_keys($this->columns) as $column)
				if(isset($row[$column]))
				{
					$renderedRow[$column] = $row[$column];  
					$this->createCell($column, $renderedRow[$column]);
				}

			$this->fireEvent("createRow", $renderedRow);
			
			$row = $renderedRow;
		}
		
		public function createCell($column, &$value)
		{
			$this->fireEvent("format$column", $value);
			$this->fireEvent("createCell", $value);
		}
		
		private final function alternate()
		{
			if(!isset($this->rowAlternator[$this->alternatorCount]))
				$this->alternatorCount = 0;
			$this->alternator = $this->rowAlternator[$this->alternatorCount];
			$this->alternatorCount++;
		}
		
		public static function columnPosition($column)
		{
			$comparer = array_keys($this->columns);
			foreach($comparer as $index => $columnName)
				if($column == $columnName)
					return $index;
		}
	}

?>