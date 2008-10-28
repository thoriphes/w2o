<?php

	interface DBEngine
	{
		public function connect();
		public function close();
		public function query($query);
		public function multi_query($query);
	}

?>