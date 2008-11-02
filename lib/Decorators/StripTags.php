<?php

	class StripTags extends Decorator
	{
		public function run(&$data = null)
		{
			strip_tags($data);
		}
	}

?>