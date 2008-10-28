<?php

	class ArticlesController extends Controller
	{
		protected $name = "articles";
		
		public function __construct($action = Router::DEFAULT_ACTION)
		{
			parent::__construct($action);
		}
		
		public function index()
		{
			$this->set('articles', $this->model->findAll());
		}
	}

?>