<?php

	class W2O
	{
		const DEFAULT_DOCTYPE = "XHTML11";
		const DEFAULT_ENCODING = "UTF-8";
		
		static $packages = array(
			"Application"			=> "Core",
			"Router"				=> "Core",
			"Route"					=> "Core",
			"Support"				=> "Core",
			"View"					=> "Core/MVC",
			"AppModel"				=> "Core/MVC/Model",
			"Model"					=> "Core/MVC/Model",
			"Controller"			=> "Core/MVC/Controller",
			"AppController"			=> "Core/MVC/Controller",
			"ControllerParameters"	=> "Core/MVC/Controller",
			"DataRecord"			=> "DataRecord",
			"DataRecord"			=> "DataRecord",
			"DataRetriever"			=> "DataRecord",
			"PropertyRetriever"		=> "DataRecord",
			"IdRetriever"			=> "DataRecord",
			"DataProperty"			=> "DataRecord/PropertyTypes",
			"DefaultType"			=> "DataRecord/PropertyTypes",
			"Decorator"				=> "Decorators",
			"Decorated"				=> "Decorators",
			"TopDataAddition"		=> "Decorators",
			"BottomDataAddition"	=> "Decorators",
			"SanitizeString"		=> "Decorators",
			"Imploder"				=> "Decorators",
			"StripTags"				=> "Decorators",
			"RemoveBreaks"			=> "Decorators",
			"DocType"				=> "Decorators/XHTML/Factories",
			"HTMLHead"				=> "Decorators/XHTML/Factories",
			"HTMLMeta"				=> "Decorators/XHTML/Factories",
			"JSScript"				=> "Decorators/XHTML/Factories",
			"Stylesheet"			=> "Decorators/XHTML/Factories",
			"MetaDescription"		=> "Decorators/XHTML/Factories",
			"MetaLang"				=> "Decorators/XHTML/Factories",
			"MetaEncoding"			=> "Decorators/XHTML/Factories",
			"ViewFomatter"			=> "Decorators/XHTML",
			"WEBFormatterDoctype"	=> "Decorators/XHTML",
			"HeadAdder"				=> "Decorators/XHTML",
			"TagOpener"				=> "Decorators/XHTML",
			"TagCloser"				=> "Decorators/XHTML",
			"TagWrapper"			=> "Decorators/XHTML",
			"TagWrapperHTML"		=> "Decorators/XHTML",
			"TableHeader"			=> "Decorators/XHTML",
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
			"FieldDefinition"		=> "DBAccess/Definition",
			"Table"					=> "Controls/Lists",
			"Paginator"				=> "Controls/Lists",
			"Column"				=> "Controls/Lists/Columns",
			"ColumnPreview"			=> "Controls/Lists/Columns",
			"ColumnButtons"			=> "Controls/Lists/Columns",
			"ColumnLink"			=> "Controls/Lists/Columns"
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