<?php

	class IdRetriever extends PropertyRetriever 
	{
		public function __construct($value)
		{
			parent::__construct(DataRecord::IDENTITY_KEY, $value);
		}
	}

?>