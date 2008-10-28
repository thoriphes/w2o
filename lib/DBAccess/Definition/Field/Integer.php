<?php
	/**
	 * Field specialization for integer fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class IntegerField extends FieldDefinition 
	{
		/**
		 * Default field size.
		 *
		 */
		const DEFAULT_SIZE = 10;
		
		/**
		 * Field type identifier
		 * 
		 */
		const TYPE 		   = "int";
		
		/**
		 * Inicialization with field spec values
		 *
		 * @param string $name
		 * @param int $size
		 */
		public function __construct($name, $size = self::DEFAULT_SIZE)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
			$this->setSize($size);
		}
		
	}

?>