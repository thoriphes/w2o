<?php
	/**
	 * Field specialization short text fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class VarcharField extends StringField 
	{
		/**
		 * Default text MAX length
		 *
		 */
		const DEFAULT_SIZE = 255;
		
		/**
		 * Field type identifier
		 *
		 */
		const TYPE 		   = "varchar";
		
		/**
		 * Inicialization with field spec values.
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