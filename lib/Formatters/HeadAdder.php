<?php

	class HeadAdder extends TopDataAddition 
	{
		const ID = "addHead";
		
		public function __construct($params = null)
		{
			$this->id = (self::ID);
			if(is_array($params))
				$this->setParams($params);
		}
		
		public function generateData($data = null)
		{
			return HTMLHead::getXHTML(
				$this->params['title'], 
				$this->params['css'], 
				$this->params['js'], 
				$this->params['lang'], 
				$this->params['encoding'], 
				$this->params['description']
			);
		}
		
		/*public function setParams(array $params)
		{
			foreach ($params as $key => &$value)
			{
				if(is_array($value))
					$value = implode(" ", $value);
			}
			
			$this->params = $params;
		}*/
	}

?>