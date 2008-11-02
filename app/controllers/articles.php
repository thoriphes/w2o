<?php

	class ArticlesController extends Controller
	{
		protected function configureView(View $view)
		{
			$view->addCSS("layout.css");
		}
		
		public function __index($page = 1)
		{
			$this->launch("list", $page);
		}
		
		public function __list($page = 1)
		{
			parent::__list($page, $this->parameters->pageSize);
			$this->set("pageSize", $this->parameters->pageSize);
			$this->set("currentPage", $page);
			$this->view->addCSS("tables.css");
		}
		
		public function __add()
		{
			parent::__add();
			$this->view->addCSS("forms.css");
		}
	
		public function __edit($id)
		{
			parent::__edit($id);
			$this->view->addCSS("forms.css");
		}
		
		public function __view($id)
		{
			$id = Support::urlDecode($id);
			$this->set('article', $this->Articles->findByField('title', $id));
			$this->view->addTitle(stripslashes($id));
		}
		
		public function __populate()
		{
			$this->Articles->delete(1);
			$listaArticulos = RSS_Display("http://www.elrincondelmanga.com/foro/external.php?type=RSS2", 50);
			foreach ($listaArticulos as $articulo)
			{
				$this->Articles->create($articulo);
			}
			header("Location:" . Support::createLinkURL($this->name, "list"));
		}
	}


	
	
	
	
	
	
	
$RSS_Content = array();

function RSS_Tags($item, $type)
{
		$y = array();
		$tnl = $item->getElementsByTagName("title");
		$tnl = $tnl->item(0);
		$title = $tnl->firstChild->data;

		$tnl = $item->getElementsByTagName("link");
		$tnl = $tnl->item(0);
		$link = $tnl->firstChild->data;

		$tnl = $item->getElementsByTagName("description");
		$tnl = $tnl->item(0);
		$description = $tnl->firstChild->data;

		$y["title"] = $title;
		$y["link"] = $link;
		$y["description"] = $description;
		$y["type"] = $type;
		
		return $y;
}


function RSS_Channel($channel)
{
	global $RSS_Content;

	$items = $channel->getElementsByTagName("item");
	
	// Processing channel
	
	$y = RSS_Tags($channel, 0);		// get description of channel, type 0
	array_push($RSS_Content, $y);
	
	// Processing articles
	
	foreach($items as $item)
	{
		$y = RSS_Tags($item, 1);	// get description of article, type 1
		array_push($RSS_Content, $y);
	}
}

function RSS_Retrieve($url)
{
	global $RSS_Content;

	$doc  = new DOMDocument();
	$doc->load($url);

	$channels = $doc->getElementsByTagName("channel");
	
	$RSS_Content = array();
	
	foreach($channels as $channel)
	{
		 RSS_Channel($channel);
	}
	
}


function RSS_RetrieveLinks($url)
{
	global $RSS_Content;

	$doc  = new DOMDocument();
	$doc->load($url);

	$channels = $doc->getElementsByTagName("channel");
	
	$RSS_Content = array();
	
	foreach($channels as $channel)
	{
		$items = $channel->getElementsByTagName("item");
		foreach($items as $item)
		{
			$y = RSS_Tags($item, 1);	// get description of article, type 1
			array_push($RSS_Content, $y);
		}
		 
	}

}


function RSS_Links($url, $size)
{
	global $RSS_Content;

	$page = "<ul>";

	RSS_RetrieveLinks($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, 0, $size);

	foreach($recents as $article)
	{
		$type = $article["type"];
		if($type == 0) continue;
		$title = $article["title"];
		$link = $article["link"];
		$page .= "<li><a href=\"$link\">$title</a></li>\n";			
	}

	$page .="</ul>\n";

	return $page;
	
}



function RSS_Display($url, $size)
{
	global $RSS_Content;

	$opened = false;
	$page = "";

	RSS_Retrieve($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, 0, $size);

	foreach($recents as &$recent)
	{
		$recent["content"] = $recent["description"];
	}
		
	return $recents;
	
}
	
?>