<?php

	class MySQLQueryFormatter extends Decorator
	{
		public function run(&$data = null)
		{
			if($data instanceof mysqli_result)
			{
				$return["field_count"] 	= $data->field_count;
				$return["num_rows"] 	= $data->num_rows;
				$return["total_rows"]	= $data->total_rows;
				$return["request_time"]	= $data->request_time;
				$rows = array();
				
				while($row = $data->fetch_assoc())
					$rows[] = $row;
					
				$return["data"] = $rows;
				
				$data = $return;
			}
		}
	}

?>