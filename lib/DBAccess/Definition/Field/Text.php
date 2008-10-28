<?php
	/**
	 * Field specialization long non-binary text fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class TextField extends StringField 
	{
		/**
		 * Field type identifier
		 *
		 */
		const TYPE 		   = "text";
		
		/**
		 * Field initialization with spec values
		 *
		 * @param string $name
		 */
		public function __construct($name)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
		}
		
	}
?>