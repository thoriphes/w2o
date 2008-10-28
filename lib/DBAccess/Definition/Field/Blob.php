<?php
	/**
	 * Field specialization for binary long text fields.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class BlobField extends FieldDefinition 
	{
		/**
		 * Type identifier
		 *
		 */
		const TYPE 		   = "blob";
		
		/**
		 * Inicialization with field spec values.
		 *
		 * @param string $name
		 */
		public function __construct($name)
		{
			$this->setName($name);
			$this->setType(self::TYPE);
			$this->setBinary();
		}
		
	}

?>