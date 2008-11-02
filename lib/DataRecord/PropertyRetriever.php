<?php

	class PropertyRetriever extends DataRetriever 
	{
		public function __construct($property, $value)
		{
			parent::addCondition($property, $value);
		}
	}

?>