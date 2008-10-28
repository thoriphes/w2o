<?php

	class StripTags extends Decorator
	{
		public function run($data = null)
		{
			return strip_tags($data);
		}
	}

?>