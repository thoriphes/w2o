<?php

	class JSScript
	{
		public static function getXHTML($file)
		{
			if($file != "")
				return "<script type='text/javascript' src='".JS_URL."$file'></script>\n";
		}
	}

?>