<?php

	class View {
		
		const TITLE_TOKENIZER = ' | ';
		const DEFAULT_ENCODING = 'utf-8';
		
		protected 
			$decorators 	= array(),
			$file,
			$layout 		= Application::DEFAULT_LAYOUT,
			$encoding 		= self::DEFAULT_ENCODING,
			$css 			= array(),
			$title;
		
		public function __construct()
		{
			if(defined('APP_NAME'))
				$this->addTitle(APP_NAME);
				
			foreach(Application::$viewDecorators as $event => $decorators)
				foreach($decorators as $decorator)
					$this->addDecorator($event, $decorator);
		}
		
		public function addCSS($css)
		{
			$this->css[] = $css;
		}
		
		public function setTitle($title)
		{
			$this->title = $title;
		}
		
		public function addTitle($title)
		{
			if($this->title != "")
				$this->title .= self::TITLE_TOKENIZER;
			$this->title .= $title;
		}
		
		public function setLayout($layout)
		{
			$this->layout = $layout;
		}
			
		public function setFile($file)
		{
			$this->file = $file;
		}
		
		public function renderView($data)
		{
			extract($data, EXTR_SKIP);
			ob_start();
				include($this->file);
			$out = ob_get_clean();
			return $out;
		}
		
		public function renderLayout($data)
		{
			$layout = $data;
			$layoutFile = LAYOUTS_DIR . "/$this->layout";
			
			if(is_file($layoutFile))
			{
				$content = $data;
				ob_start();
					include($layoutFile);
				$layout = ob_get_clean();
			}
			$this->beforeRender(&$layout);			
			return $layout;
		}
		
		public function render($data)
		{
			$time = microtime(true);
			$viewRender = $this->renderView($data);
			echo $this->renderLayout($viewRender);
		}
		
		protected function generateHeaderArray()
		{
			return array(
				'css' 		=> $this->css,
				'title' 	=> $this->title,
				'encoding' 	=> $this->encoding
			);
		}
		
		protected function beforeRender($data)
		{
			if(isset($this->decorators["beforeRender"][HeadAdder::ID]))
				$this->decorators["beforeRender"][HeadAdder::ID]->setParams($this->generateHeaderArray());
			
			if(count($this->decorators["beforeRender"])) 
				foreach($this->decorators["beforeRender"] as $decorator)
					$decorator->run($data);
				
			return $data;
		}
		
		public function addDecorator($event, Decorator $decorator)
		{
			$this->decorators[$event][$decorator->getId()] = $decorator;
		}
		
		public function removeDecorator($event, Decorator $decorator)
		{
			unset($this->decorators[$event][$decorator->getId()]);
		}
		
		public function clearDecorators()
		{
			$this->decorators = array();
		}
		
	}

?>