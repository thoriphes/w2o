<?php

	class Article extends DataRecord 
	{
		
		const TABLE = "articles";
		protected $table = "articles";
		
		public
			$title,
			$content,
			$creation;
	}

?>