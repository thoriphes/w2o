<?php

	class TagWrapperHTML extends TagWrapper  
	{
		const TAGNAME = "html";
		const DEFAULT_LANG = "es";
		
		public function __construct($lang = self::DEFAULT_LANG)
		{
			$this->id = self::ID_PREFIX . self::TAGNAME;
			
			$this->addDecorator("run", new TagOpener(self::TAGNAME, array(
				'xml:lang' 	=> $lang,
				'xmlns' 	=> "http://www.w3.org/1999/xhtml"
			)));
			$this->addDecorator("run", new TagCloser(self::TAGNAME));
		}
		
	}

?>