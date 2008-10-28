<?php

	class DocType
	{
		static $doctypes = array(
			'xhtml11'	=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'
		);
		
		public static function getXHTML($doctype)
		{
			return self::$doctypes[strtolower($doctype)];
		}
	}

?>