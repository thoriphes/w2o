<?php
	/**
	 * Interface an object must provide to be a tables manipulator.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Engines
	 */
	interface TableManipulator 
	{
		public function getTables();
		
		public function tableExists($tableName);
		
		public function createTable(DBAccess_Definition_Table $table);
		
		public function alterTable(DBAccess_Definition_Table $table);
		
		public function truncateTable($tableName);
		
		public function getTableInfo($tableName);
		
		public function getTableColumns($tableName);
		
		public function getFieldInfo($tableName, $field);
		
	}

?>