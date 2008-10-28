<?php
	/**
	 * Field specialization for float fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class FloatField extends FieldDefinition 
	{
		/**
		 * Default field integer part size.
		 *
		 */
		const DEFAULT_SIZE = 10;
		
		/**
		 * Default field decimal part size.
		 *
		 */
		const DECIMALS	   = 2;
		
		/**
		 * Field type identifier
		 *
		 */
		const TYPE 		   = "float";
		
		/**
		 * Inicialization with field spec values
		 *
		 * @param string $name
		 * @param int $size
		 * @param int $decimals
		 */
		public function __construct($name, $size = self::DEFAULT_SIZE, $decimals = self::DECIMALS)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
			$this->setSize("$size,$decimals");
		}
		
	}
?>