<?php
	class MetaLang extends HTMLMeta  
	{
		public static function getXHTML($lang)
		{
			return parent::getXHTML("Content-Language", "$lang");
		}
	}
?>