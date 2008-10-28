<?php

	class MySQLQueryFormatter extends Decorator
	{
		public function run($data = null)
		{
			$return["field_count"] 	= $data->field_count;
			$return["num_rows"] 	= $data->num_rows;
			
			$rows = array();
			
			while($row = $data->fetch_assoc())
				$rows[] = $row;
				
			$return["data"] = $rows;
			
			return $return;
		}
	}

?>