<?php

	interface Decorated {
		
		public function addDecorator($event, Decorator $decorator);
		public function removeDecorator($event, Decorator $decorator);
		public function fireEvent($event, &$data = null);
		
	}

?>