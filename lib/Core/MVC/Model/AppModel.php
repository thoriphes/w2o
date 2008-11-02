<?php

	abstract class AppModel
	{
		protected 
			$name,
			$table,
			$datarecord;
			
		protected 
			$hasMany 	= array(),
			$hasOne  	= array(),
			$belongsTo 	= array();
		
		public function __construct($name = null)
		{
			$this->init();
		}
		
		public function setName($name)
		{
			$this->name = $name;
		}
		
		public function getName()
		{
			return $this->name;
		}
		
		protected function find($condition = 1, $page = 1, $ammount = 0, $fields = "*")
		{
			Application::$dataManager->useManager($this->getName());
			
			if($ammount != 0)
				$limit = "LIMIT " . (intval($page)-1) * $ammount . ", $ammount";
			
			return Application::$dataManager->retrieveRow($this->table, $fields, $condition, $limit);
		}
		
		public function findDataRecords($condition)
		{
			Application::$dataManager->useManager($this->getName());
			$result = array();
			$idsList = $this->find($condition,1,0,DataRecord::IDENTITY_KEY);
			foreach ($idsList['data'] as $dataRecord)
				$result[$dataRecord['id']] = clone($this->recoverDataRecord($dataRecord['id'])); 
			return $result;
		}
		
		public function delete($condition = 0)
		{
			$result = true;
			$dataRecords = $this->findDataRecords($condition);
			foreach($dataRecords as $data)
				$result = $result && $data->purge();
			return $result;
		}
		
		public function create(array $data)
		{
			Application::$dataManager->useManager($this->getName());
			$this->datarecord->setHash($data);
			$id = $this->datarecord->save();
			$this->resetDataRecord();
			return $id;
		}
		
		public function modify(array $data, $condition)
		{
			$result = true;
			$dataRecords = $this->findDataRecords($condition);
			foreach($dataRecords as $dataRecord)
			{
				$dataRecord->setHash($data);
				$result = $result && $dataRecord->save();
			}
			return $result;
		}
		
		private final function init()
		{
			$this->initName();
			$this->initDataRecord();
			$this->initTable();
		}
		
		private final function initTable()
		{
			if(!isset($this->table))
				$this->table = $this->name;
		}
		
		private final function initName()
		{
			if(!isset($this->name))
				$this->name = $this->generateName();
		}
		
		private final function generateName()
		{
			return strtolower(str_replace("Model", "", get_class($this)));
		}
		
		private final function cleanDataForDB(&$data)
		{
			if(!is_array($data))
				$data = array($data);
			foreach($data as $value)
			{
				$value = html_entity_decode($value);
				$value = stripslashes($value);
			}
			return $data;
		}
		
		private final function initDataRecord()
		{
			require_once(DATARECORDS_DIR . "/$this->name.php");
			$className = ucwords($this->name);
			
			if(substr($className, strlen($className) - 1, 1) == "s")
				$className = substr($className, 0, strlen($className) - 1);
			
			if(!isset($this->datarecord))
				$this->datarecord = new $className();
		}
		
		private final function recoverDataRecord($id = null)
		{
			$className = get_class($this->datarecord);
				$this->datarecord = new $className($id);
			return $this->datarecord;
		}
		
		private final function resetDataRecord()
		{
			$this->recoverDataRecord(null);		
		}
	}

?>