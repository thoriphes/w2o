<?php
	/**
	 * Field specialization for lastUpdate fields. Will store last row modifiaction timestamp.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 * @subpackage Field
	 */
	class ModificationTimeField extends TimestampField
	{
		/**
		 * Field inicialization with spec values
		 *
		 * @param string $name
		 */
		public function __construct($name)
		{
			parent::__construct($name);
			$this->setAsModificationTimeStamp();
		}
		
	}

?>