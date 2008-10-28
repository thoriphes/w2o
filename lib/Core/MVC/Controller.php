<?php

	class Controller
	{
		const DEFAULT_LAYOUT = "main.tpl";
		
		protected $name;
		
		protected $data = array();
		protected $model;
		protected $view;
		
		public $autoRender = true;
		
		public function __construct($action = Router::DEFAULT_ACTION)
		{
			$this->model 	= Application::$model;
			$this->view 	= Application::$view;
			
			$this->launch($action);
		}			
		
		protected function set($var, $data)
		{
			$this->data[$var] = $data;
		}
		
		protected function launch($action)
		{
			try {
				$function = new ReflectionMethod(get_class($this), $action);
				$functionName = $function->getName();
				$this->$functionName();
			}
			
			catch (Exception $e)
			{
				;
			}
			
		}
		
		public function render()
		{
			$this->view->render($this->data);
		}
		
	}

?>