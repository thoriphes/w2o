<?php

	class View {
		
		protected 
			$decorators = array(),
			$file,
			$layout,
			$css = array();
		
		public function __construct()
		{
			
		}
			
		public function addCSS($css)
		{
			$this->css[] = $css;
		}
		
		public function setLayout($layout)
		{
			$this->layout = $layout;
		}
			
		public function setFile($file)
		{
			$this->file = $file;
		}
		
		protected function renderView($data)
		{
			extract($data, EXTR_SKIP);
			ob_start();
			@include($this->file);
			$out = ob_get_clean();
			return $out;
		}
		
		public function render($data)
		{
			$viewRender = $this->renderView($data);

			
			$layoutFile = LAYOUTS_DIR . "/$this->layout";

			$layout = $viewRender;
			
			
			if(is_file($layoutFile))
			{
				$content = $viewRender;
				
				ob_start();
					include($layoutFile);
				$layout = ob_get_clean();
			}
			
			$this->beforeRender(&$layout);
	
			echo $layout;
			
		}
		
		protected function generateHeaderArray()
		{
			return array(
				'css' => $this->css
			);
		}
		
		protected function beforeRender($data)
		{
			if(isset($this->decorators["beforeRender"][HeadAdder::ID]))
				$this->decorators["beforeRender"][HeadAdder::ID]->setParams($this->generateHeaderArray());
			
			if(count($this->decorators["beforeRender"])) 
				foreach($this->decorators["beforeRender"] as $decorator)
					$data = $decorator->run($data);
				
			return $data;
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->decorators[$event][$decorator->getId()] = $decorator;
		}
		
	}

?>