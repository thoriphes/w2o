<?php

	class Route
	{
		protected
			$name,
			$model,
			$view,
			$controller;
			
		public function __construct($name, $params = null)
		{
			$model = $name;
			$view = $name;
			$controller = $name;
			
			if(is_array($params))
				extract($params, EXTR_OVERWRITE);
			
			$this->name = $name;
			$this->setModel($model);
			$this->setView($view);
			$this->setController($controller);
		}
		
		public function setModel($model)
		{
			$this->model = $model;
		}
		
		public function setView($view)
		{
			$this->view = $view;
		}
		
		public function setController($controller)
		{
			$this->controller = $controller;
		}
		
		public function getModel()
		{
			return $this->model;
		}
		
		public function getView()
		{
			return $this->view;
		}
		
		public function getController()
		{
			return $this->controller;
		}
		
		public function getName()
		{
			return $this->name;
		}
	}

?>