<?php

	abstract class AppController
	{
		public
			$name,
			$parameters;
		
		protected 
			$data 			= array(),
			$models 		= array(),
			$view,
			$currentAction;
				
		public final function __construct($action = Router::DEFAULT_ACTION, $params = null)
		{
			$this->_init($action);
			$this->launch($action, $params);
		}
		
		public function render()
		{
			$this->view->setFile(Support::sanitizePath(VIEWS_DIR . "/$this->name/$this->currentAction.tpl"));
			$this->view->render($this->data);
		}
		
		protected function set($var, $data)
		{
			$this->data[$var] = $data;
		}
		
		protected function launch($action, $params = null)
		{
			$this->currentAction = $action;
			
			if(is_array($params) && count($params) == 1)
				$params = $params[0];
				
			if(is_array($params) && !count($params))
				unset($params);
				
			try {
				$function = new ReflectionMethod(get_class($this), "__".$action);
				$functionName = $function->getName();
				if(!is_null($params))
					$this->$functionName($params);
				else $this->$functionName();
			}
			
			catch (Exception $e)
			{
				$this->autoRender = false;
				$this->flash("Action $action is not defined for controller $this->name.");
			}
		}
		
		protected function init()
		{
			
		}
		
		protected function configureView(View &$view)
		{
			
		}
		
		
		// CONTROLLER INIT
		
		private final function registerModel(Model $model)
		{
			$varName = ucwords($model->getName());
			$this->$varName = $model;
		}
		
		private final function _init($action) 
		{
			$this->initName();
			$this->initParameters();
			$this->initModels();
			$this->initView();
			$this->init();
		}
		
		private final function initParameters()
		{
			$this->parameters = new ControllerParameters();
		}
		
		private final function initName()
		{
			if(!isset($this->name))
				$this->name = $this->generateName();
		}
		
		private final function generateName()
		{
			return strtolower(str_replace("Controller", "", get_class($this)));
		}

		private final function initModels()
		{
			array_push($this->models, $this->name);
			foreach(array_unique($this->models) as $model)
			{
				$className = ucwords($model . "Model");
				require_once(MODELS_DIR . "/$model.php");
				$this->registerModel(new $className());
			}
		}
		
		private final function initView()
		{
			$this->view = new View();
			$this->view->setLayout($this->parameters->layoutFile);
			$this->view->addTitle($this->name);
			$this->configureView($this->view);
		}
		
	}

?>