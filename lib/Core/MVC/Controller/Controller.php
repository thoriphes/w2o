<?php

	class Controller extends AppController 
	{
		public function __list($page = 1, $size = 10)
		{
			$this->set('articles', $this->{ucwords($this->models[0])}->findAll($page, $size));
		}
		
		public function __add()
		{
			if(count($_POST) && $this->{ucwords($this->models[0])}->create($_POST))
				header("Location: ". Support::createLinkURL($this->name));
		}
	
		public function __edit($id)
		{
			$id = Support::urlDecode($id);

			if(count($_POST) && $this->{ucwords($this->models[0])}->modifyById($_POST, $id))
				header("Location: ". Support::createLinkURL($this->name));
										
			$this->set(substr($this->name,0,strlen($this->name) - 1), $this->{ucwords($this->models[0])}->findByField('id', $id));
		}
		
		public function __view($id)
		{
			$id = Support::urlDecode($id);
			$this->set(substr($this->name,0,strlen($this->name) - 1), $this->{ucwords($this->models[0])}->findByField('id', $id));
		}
		
		public function __delete($id)
		{
			$id = Support::urlDecode($id);
			
			if($this->{ucwords($this->models[0])}->deleteById($id))
				header("Location: ". Support::createLinkURL($this->name));
		}
	}

?>