<?php

	class WEBFormatterDoctype extends TopDataAddition  
	{
		const ID = "addDocType";
		
		public function __construct($doctype)
		{
			$this->id = self::ID;
			
			$this->setParams(array(
				'doctype' => $doctype
			));
		}
		
		public function generateData()
		{
			return DocType::getXHTML($this->params['doctype']) . "\n";
		}
	}

?>