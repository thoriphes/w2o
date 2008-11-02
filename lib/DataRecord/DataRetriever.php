<?php

	abstract class DataRetriever
	{
		protected $conditions = array();
		
		public function addCondition($field, $value)
		{
			$this->conditions[$field] = $value;
		}
		
		public function getConditions()
		{
			return $this->conditions;
		}
	}

?>