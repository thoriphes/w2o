<?php
	
	class MetaEncoding extends HTMLMeta  
	{
		public static function getXHTML($encoding)
		{
			return parent::getXHTML("Content-Type", "text/html; charset=$encoding");
		}
}
?>