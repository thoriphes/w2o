<?php

	class MySQLManager extends DatabaseManager 
	{
		public function __construct(Database $database)
		{
			parent::__construct(new MySQLEngine($database));
		}
		
		public function getTables()
		{
			return $this->engine->query("SHOW TABLES FROM {$this->engine->getDatabase()->getName()}");
		}
		
		public function tableExists($tableName)
		{
			$result = $this->engine->query("SHOW TABLES FROM {$this->engine->getDatabase()->getName()} LIKE '$tableName'");
			return (bool) count($result->getData());
		}
		
		public function truncateTable($tableName) 
		{
			return $this->engine->query("TRUNCATE TABLE `$tableName`");
		}
		
		public function dropTable($tableName)
		{
			return $this->engine->query("DROP TABLE IF EXISTS `$tableName`");
		}
		
		public function getTableInfo($tableName)
		{
			return $this->engine->query("SHOW TABLE STATUS LIKE '$tableName'");
		}
		
		public function getTableColumns($tableName)
		{
			return $this->engine->query("SHOW COLUMNS FROM `$tableName`");
		}
		
		public function getFieldInfo($tableName, $field)
		{
			return $this->engine->query("SHOW COLUMNS FROM `$tableName` WHERE `Field` LIKE '$field'");
		}
		
		public function createTable(DBAccess_Definition_Table $table)
		{
			if($this->tableExists($table->name))
				return $this->alterTable($table);
			return $this->engine->query($this->factory->getCreationSQL($table));
		}
		
		public function alterTable(DBAccess_Definition_Table $table)
		{
			if(!$this->tableExists($table->name))
				return $this->createTable($table);
		}
		
		public function insertRow($tableName, array $row)
		{
			$insert = array();
			
			foreach ($row as $field => $value)
				$insert["`$field`"] = "'$value'";
			
			$fieldsList = implode(", ", array_keys($insert));
			$valuesList = implode(", ", array_values($insert));
			return $this->engine->query("INSERT INTO `$tableName` ($fieldsList) VALUES ($valuesList)");
		}
		
		public function modifyRow($tableName, array $row, $condition)
		{
			foreach ($row as $field => &$value)
				$value = "`$field`='$value'";

			$valuesList = implode(", ", array_values($row));
			return $this->engine->query("UPDATE `$tableName` SET $valuesList WHERE $condition");
		}
	}

?>