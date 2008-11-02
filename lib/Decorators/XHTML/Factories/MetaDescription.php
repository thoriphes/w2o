<?php
	class MetaDescription extends HTMLMeta  
	{
		public static function getXHTML($description)
		{
			if(SanitizeString::run($description) != "")
				return parent::getXHTML("Description", SanitizeString::run($description));
		}
	}
?>
