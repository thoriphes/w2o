<?php

	class StyleSheet
	{
		const DEFAULT_MEDIA = "screen";
		
		public static function getXHTML($file, $media = self::DEFAULT_MEDIA)
		{
			if($file != "")
				return "<link rel='stylesheet' type='text/css' media='$media' href='".CSS_URL."$file' />\n";
		}
	}

?>