<?php

	class ColumnPreview extends Column
	{
		const LENGTH = 50;
		
		protected $length;
		
		public function __construct($columnName, $length = self::LENGTH)
		{
			$this->length = $length;
			$this->id = $columnName;
		}
		
		public function run(&$data = null)
		{
			$data = strip_tags($data);
			if(strlen($data) > $this->length)
			{
				$data = substr($data, 0, strpos($data, " ", $this->length));
				$data .= "…";
			}
		}
	}

?>