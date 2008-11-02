<?php

	class Model extends AppModel
	{
		public function deleteByProperty($property, $value)
		{
			return $this->delete("$property='$value'");
		}
		
		public function deleteById($id)
		{
			return $this->delete(DataRecord::IDENTITY_KEY."=$id");
		}
		
		public function findAll($page, $size)
		{
			return $this->find(1, $page, $size);
		}
	
		public function findByField($field, $value)
		{
			return $this->find("$field='$value'");
		}
		
		public function modifyById(array $data, $id)
		{
			return $this->modify($data, DataRecord::IDENTITY_KEY."='$id'");
		}
	}

?>