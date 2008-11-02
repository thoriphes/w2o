<?php

	class DefaultType extends DataProperty
	{
		public function in($data)
		{
			return $data;
		}
		
		public function out($data)
		{
			return $data;
		}
	}

?>