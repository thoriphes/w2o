<?php
	/**
	 * Field specialization date/time fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class TimestampField extends FieldDefinition 
	{
		/**
		 * Field length (timestamp's length)
		 *
		 */
		const LENGTH 	   = 10;
		
		/**
		 * Field type identifier
		 *
		 */
		const TYPE 		   = "int";
		
		/**
		 * Field iicialization with spec values
		 *
		 * @param string $name
		 */
		public function __construct($name)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
			$this->setSize(self::LENGTH);
		}
		
	}

?>