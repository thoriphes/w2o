<?php
	/**
	 * Interface an object must provide to be a databases manipulator.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Engines
	 */
	interface DBManipulator 
	{
		public function dataBaseExists($dbName);
		
		public function createDatabase($databaseName);
		
		public function dropDatabase($databaseName);
		
		public function truncateDatabase($databaseName);
	}

?>