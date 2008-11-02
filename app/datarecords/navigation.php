<?php

	class Navigation extends DataRecord 
	{
		
		const TABLE = "navigation";
		protected $table = "navigation";
		
		public
			$title,
			$url;
	}

?>