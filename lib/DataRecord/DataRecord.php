<?php

	abstract class DataRecord
	{
		const IDENTITY_KEY 	= "id";
		const NOT_PERSISTED = false;
		
		public 
			$id = self::NOT_PERSISTED,
			$creation,
			$modification;
		
		protected 
			$table,
			$dataManager,
			$searchKey = self::IDENTITY_KEY;
		
		public function __construct($identity = null)
		{
			if(!is_null($identity)) $this->retrieve($this->generateRetriever($identity));
		}
		
		public function setProperty($property, $value)
		{
			if($this->hasField($property))
			{
				$type = $this->getPropertyType($property);
				$this->$property = $type->in($value);
			}
		}
		
		public function getProperty($property)
		{
			if($this->hasField($property))
			{
				$type = $this->getPropertyType($property);
				return $type->out($this->$property);
			}
		}
		
		public function setPropertyType($property, DataProperty $type)
		{
			if($this->hasField($property))
			{
				$this->types[$property] = $type;
				$type->setPropertyName($property);
			}
		}
		
		public function getPropertyType($property)
		{
			if($this->hasField($property))
			{
				$type = new DefaultType($property);
				if(isset($this->types[$property]))
					$type = $this->types[$property];
				
				$this->types[$property] = $type;
				return $type;
			}
		}
		
		public function setPropertyMeta($property, $meta, $value)
		{
			$type = $this->getPropertyType($property)->setMeta($meta, $value);
		}
		
		public function getPropertyMeta($property, $meta)
		{
			$type = $this->getPropertyType($property)->getMeta($meta);
		}
		
		public function getId()
		{
			return $this->getProperty(self::IDENTITY_KEY);
		}
		
		public function getFields()
		{
			$fields 		= array();
			$recordType 	= new ReflectionClass(get_class($this));
			$classFields 	= $recordType->getProperties();
			
			foreach ($classFields as $field)
				if ($field->isPublic())
					array_push($fields,$field->getName());
				
			return $fields;
		}
		
		public function getHash()
		{
			$hash = array();
			foreach($this->getFields() as $field)
				$hash[$field] = $this->getProperty($field);
			
			unset($hash[self::IDENTITY_KEY]);
			
			return $hash;
		}
		
		public function setHash(array $hashMap)
		{
			foreach($hashMap as $property => $value)
				$this->setProperty($property, $value);
		}
		
		public function save()
		{
			if(!$this->getProperty(self::IDENTITY_KEY))
				return $this->create();
			else return $this->modify();
		}
		
		public function purge()
		{
			$this->fireEvent("purge", $this);
			return Application::$dataManager->deleteRow($this->table, self::IDENTITY_KEY . "=" . $this->getId());
		}
		
		protected function retrieve(DataRetriever $retriever)
		{
			$row = Application::$dataManager->retrieveRow($this->table, $this->getFields(), $retriever->getConditions());
			if(isset($row['data'][0]))
				$this->setHash($row['data'][0]);
			$this->fireEvent("retrieve", $this);
		}
		
		protected function create()
		{
			$this->creation = time();
			$this->setProperty(self::IDENTITY_KEY, Application::$dataManager->insertRow($this->table, $this->getHash()));
			$this->fireEvent("create", $this);
			return $this->getId();
		}
		
		
		protected function modify()
		{
			$this->modification = time();
			$this->fireEvent("modify", $this);
			return Application::$dataManager->modifyRow($this->table, $this->getHash(), self::IDENTITY_KEY . "=" . $this->getId());
		}
		
		public final function hasField($field)
		{
			$result = true;
			
			try {
				$refelectionProperty = new ReflectionProperty(get_class($this), $field);
			}
			catch (Exception $e) {
				$result = false;
			}
			
			return $result;
		}
		
		protected function fireEvent($event, &$data = null)
		{
			
		}
		
		protected function generateRetriever($identity)
		{
			if(!($identity instanceof DataRetriever))
				$identity = new PropertyRetriever($this->searchKey, $identity);
			return $identity;
		}
	}

?>