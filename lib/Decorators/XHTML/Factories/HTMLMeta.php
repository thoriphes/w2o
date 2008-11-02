<?php

	class HTMLMeta
	{
		const DEFAULT_PROPERTY_NAME = "http-equiv";
		
		public static function getXHTML($name, $value, $propertyName = self::DEFAULT_PROPERTY_NAME)
		{
			return "<meta $propertyName='$name' content='$value' />\n";
		}
}

?>