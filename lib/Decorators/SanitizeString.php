<?php

	class SanitizeString extends Decorator 
	{
		public function run($data = null)
		{
			$data = StripTags::run($data);
			$data = RemoveBreaks::run($data);
			return $data;
		}
	}

?>