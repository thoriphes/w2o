<?php

	class W2O
	{
		const DEFAULT_DOCTYPE = "XHTML11";
		const DEFAULT_ENCODING = "UTF-8";
		
		static $packages = array(
			"Application"			=> "Core",
			"Router"				=> "Core",
			"Route"					=> "Core",
			"View"					=> "Core/MVC",
			"Model"					=> "Core/MVC",
			"Controller"			=> "Core/MVC",
			"Decorator"				=> "Decorators",
			"Decorated"				=> "Decorators",
			"TopDataAddition"		=> "Decorators",
			"BottomDataAddition"	=> "Decorators",
			"SanitizeString"		=> "Decorators",
			"StripTags"				=> "Decorators",
			"RemoveBreaks"			=> "Decorators",
			"DocType"				=> "Formatters/Factories",
			"HTMLHead"				=> "Formatters/Factories",
			"HTMLMeta"				=> "Formatters/Factories",
			"JSScript"				=> "Formatters/Factories",
			"Stylesheet"			=> "Formatters/Factories",
			"MetaDescription"		=> "Formatters/Factories",
			"MetaLang"				=> "Formatters/Factories",
			"MetaEncoding"			=> "Formatters/Factories",
			"ViewFomatter"			=> "Formatters",
			"WEBFormatterDoctype"	=> "Formatters",
			"HeadAdder"				=> "Formatters",
			"TagOpener"				=> "Formatters",
			"TagCloser"				=> "Formatters",
			"TagWrapper"			=> "Formatters",
			"TagWrapperHTML"		=> "Formatters",
			"Database" 				=> "DBAccess",
			"DataManager"			=> "DBAccess",
			"MySQLQueryFormatter"	=> "DBAccess",
			"DBEngine" 				=> "DBAccess/Interfaces",
			"DBManipulator" 		=> "DBAccess/Interfaces",
			"DataManipulator" 		=> "DBAccess/Interfaces",
			"TableManipulator"		=> "DBAccess/Interfaces",
			"DBManager"				=> "DBAccess/Interfaces",
			"Engine"				=> "DBAccess/Engines",
			"MySQLEngine"			=> "DBAccess/Engines",
			"DatabaseManager"		=> "DBAccess/Managers",
			"MySQLManager"			=> "DBAccess/Managers",
			"TableDefinition"		=> "DBAccess/Definition",
			"FieldDefinition"		=> "DBAccess/Definition"
		);
		
		static $config;
		
		public static function register_auto_load()
		{
			spl_autoload_register('W2O::loadClass');
		}
		
		public static function loadClass($className)
		{
			$path = array();
			$path[] = dirname(__FILE__);
			$path[] = str_replace("/", DIRECTORY_SEPARATOR, self::$packages[$className]);
			$path[] = $className . ".php";
			$path = implode(DIRECTORY_SEPARATOR, $path);
			require_once($path);
		}
	}

	W2O::register_auto_load();
	require_once(dirname(__FILE__) . "/../config/bootstrap.php");	
?>