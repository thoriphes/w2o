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
		
		public function retrieveRow($tableName, $fields = "*", $condition = 1, $limit = "")
		{
			if(is_array($fields))
				$fields = implode(", ", $fields);
				
			if(is_array($condition))
			{
				foreach($condition as $label => &$value)
					$value = "`$label`='$value'";
				$condition = implode(", ", $condition);
			}
				
			$query = "SELECT SQL_CALC_FOUND_ROWS $fields FROM `$tableName` WHERE $condition $limit";
			
			return $this->engine->query($query);
		}
		
		public function insertRow($tableName, array $row)
		{
			$insert = array();
			
			foreach ($row as $field => $value)
			{
				if(!$this->magicQuotesOn()) $value = addslashes($value);				
				$insert["`$field`"] = "'$value'";
			}
			
			$fieldsList = implode(", ", array_keys($insert));
			$valuesList = implode(", ", array_values($insert));
			
			$query = "INSERT INTO `$tableName` ($fieldsList) VALUES ($valuesList)";
			
			return $this->engine->query($query);
		}
		
		public function modifyRow($tableName, array $row, $condition)
		{
			foreach ($row as $field => &$value)
			{
				if(!$this->magicQuotesOn()) $value = addslashes($value);
				$value = "`$field`='$value'";
			}

			$valuesList = implode(", ", array_values($row));
			$query = "UPDATE `$tableName` SET $valuesList WHERE $condition";
			return $this->engine->query($query);
		}
		
		public function deleteRow($tableName, $condition)
		{
			return $this->engine->query("DELETE FROM `$tableName` WHERE $condition");
		}
		
		protected function magicQuotesOn()
		{
			return (function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc())    || (ini_get('magic_quotes_sybase') && (strtolower(ini_get('magic_quotes_sybase'))!="off")); 
		}
	}

?>