<?php
	/**
	 * Interface an object must provide to be a data manipulator.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Engines
	 */
	interface DataManipulator
	{
		/**
		 * Inserts a row in the specified table. $row is expected to be a hash map
		 * with FIELDS => VALUES.
		 *
		 * @param string $tableName
		 * @param array $row
		 */
		public function insertRow($tableName, array $row);
		
		/**
		 * modifies row(s) in the specified table following the given condition. $row is expected to be a hash map
		 * with FIELDS => VALUES. Condition is expected to be a raw SQL condition.
		 *
		 * @param string $tableName
		 * @param array $row
		 * @param string $condition
		 */
		public function modifyRow($tableName, array $row, $condition);
	}

?>