<?php
	
	/**
	 * Field specialization for auto-increment numerical primary key fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class PrimaryKeyField extends FieldDefinition 
	{
		/**
		 * Default field name
		 *
		 */
		const DEFAULT_ID = "id";
		
		/**
		 * Field type identifier
		 *
		 */
		const TYPE		 = "int";
		
		/**
		 * Field size
		 *
		 */
		const SIZE 		 = 10;
		
		/**
		 * Field inicialization with spec value. If called without arguments,
		 * will name the field "id"
		 *
		 * @param string $name
		 */
		public function __construct($name = self::DEFAULT_ID)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
			$this->setSize(self::SIZE);
			$this->setUnsigned();
			$this->setAutoIncrement();
			$this->setRequired();
		}
		
	}

?>