<?php

	class NavigationController extends Controller
	{
		protected function configureView(View $view)
		{
			$view->setLayout(null);
			$view->clearDecorators();
		}
		
		public function __index()
		{
			$this->__list();
		}
		
		public function __list($page = 1, $size = 0)
		{
			$this->set('links', $this->Navigation->findAll($page, $size));			
		}
		
	
	}

?>