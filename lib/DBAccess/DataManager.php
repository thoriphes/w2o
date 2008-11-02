<?php

	class DataManager implements DBManager
	{
		static 
			$connectors = array(
				'mysql' => 'MySQLManager'
			),
			$currentManager = null,
			$defaultValues = array(
				'user'	=> 'root',
				'pass' 	=> '',
				'host'	=> Database::LOCALHOST
			),
			$dbManagers = array();
		
		public function createManager($id, $connector, $dbName, $dbUser, $dbPass, $dbHost = Database::LOCALHOST)
		{
			$database = new Database($dbName, $dbUser, $dbPass, $dbPass);
			$engineType = $this->getEngineType($connector);
			$this->addManager($id, new $engineType($database));			
		}
		
		public function createAutoManager($id, $connector, $dbName)
		{
			$this->createManager($id, $connector, $dbName, self::$defaultValues['user'], self::$defaultValues['pass'], self::$defaultValues['host']);
		}
		
		public function addManager($id, DatabaseManager $manager)
		{
			self::$dbManagers[$id] = $manager;
			
			if(is_null(self::$currentManager))
				self::$currentManager = $id;
				
			$this->addDecorator("query", new MySQLQueryFormatter());
		}
		
		public function removeManager($id)
		{
			if(isset(self::$dbManagers[$id]))
			{
				self::$dbManagers[$id]->close();
				unset(self::$dbManagers[$id]);
			}
		}
		
		public function useManager($id)
		{
			if(isset(self::$dbManagers[$id]))
				self::$currentManager = $id;
		}
		
		public function query($query)
		{
			return self::$dbManagers[self::$currentManager]->query($query);
		}
		
		public function getTables()
		{
			return self::$dbManagers[self::$currentManager]->getTables();
		}
		
		public function tableExists($tableName)
		{
			return self::$dbManagers[self::$currentManager]->tableExists($tableName);
		}
		
		public function truncateTable($tableName) 
		{
			return self::$dbManagers[self::$currentManager]->truncateTable($tableName);
		}
		
		public function dropTable($tableName)
		{
			return self::$dbManagers[self::$currentManager]->dropTable($tableName);
		}
		
		public function getTableInfo($tableName)
		{
			return self::$dbManagers[self::$currentManager]->getTableInfo($tableName);
		}
		
		public function getTableColumns($tableName)
		{
			return self::$dbManagers[self::$currentManager]->getTableColumns($tableName);
		}
		
		public function getFieldInfo($tableName, $field)
		{
			return self::$dbManagers[self::$currentManager]->getFieldInfo($tableName, $field);
		}
		
		public function createTable(DBAccess_Definition_Table $table)
		{
			return self::$dbManagers[self::$currentManager]->createTable($table);
		}
		
		public function alterTable(DBAccess_Definition_Table $table)
		{
			return self::$dbManagers[self::$currentManager]->alterTable($table);
		}
		
		public function retrieveRow($tableName, $fields = "*", $condition = 1, $limit = "")
		{
			return self::$dbManagers[self::$currentManager]->retrieveRow($tableName, $fields, $condition, $limit);
		}
		
		public function insertRow($tableName, array $row)
		{
			return self::$dbManagers[self::$currentManager]->insertRow($tableName, $row);
		}
		
		public function modifyRow($tableName, array $row, $condition)
		{
			return self::$dbManagers[self::$currentManager]->modifyRow($tableName, $row, $condition);
		}
		
		public function deleteRow($tableName, $condition)
		{
			return self::$dbManagers[self::$currentManager]->deleteRow($tableName, $condition);
		}
		
		private function getEngineType($type)
		{
			return self::$connectors[strtolower($type)];
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			self::$dbManagers[self::$currentManager]->addDecorator($event, $decorator);
		}
		
		public function removeDecorator($event, Decorator $decorator)
		{
			self::$dbManagers[self::$currentManager]->remove($event, $decorator);
		}
		
	}

?>