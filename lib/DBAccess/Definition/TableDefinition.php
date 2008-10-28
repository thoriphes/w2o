<?php
	/**
	 * This class represents a table structure.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 */
	class TableDefinition
	{
		/**
		 * Default table engine.
		 *
		 */
		const DEFAULT_ENGINE = "MyISAM";
		
		/**
		 * Array of fields that form the table, identified by $field->name
		 *
		 * @var array
		 */
		public $fields = array();
		
		/**
		 * Table name
		 *
		 * @var string
		 */
		public $name;
		
		/**
		 * table Collation (defaults to utf8_unicode_ci)
		 *
		 * @var string
		 */
		public $collation = "utf8_unicode_ci";
		
		/**
		 * Table comments/descripction
		 *
		 * @var string
		 */
		public $comments;
		
		/**
		 * Table data storage engine (defaults to MyISAM)
		 *
		 * @var string
		 */
		public $engine = self::DEFAULT_ENGINE;
		
		/**
		 * ID/name of the field to be labeled as primary key
		 *
		 * @var string
		 */
		public $primaryKey;
		
		/**
		 * Array of ID/names of fields to be labeled as table indexes
		 *
		 * @var array
		 */
		public $indexes = array();
		
		/**
		 * Array of ID/names of fields to be labeled as table indexes with unique attribute
		 *
		 * @var array
		 */
		public $uniques = array();
		
		/**
		 * Array of ID/names of fields to be labeled as table indexes with full text search attribute
		 *
		 * @var array
		 */
		public $fullTexts = array();
		
		/**
		 * Initialices the object setting a table name
		 *
		 * @param string $name
		 */
		public function __construct($name)
		{
			$this->setName($name);
		}
		
		/**
		 * Adds a field to the table structure. Automatically sets it as primary key
		 * if instance of DBAccess_Definition_Field_PrimaryKey
		 *
		 * @param DBAccess_Definition_Field $field
		 */
		public function addField(FieldDefinition $field)
		{
			$this->fields[$field->name] = $field;
			if($field instanceof PrimaryKeyField)
				$this->primaryKey = $field->name;
		}
		
		/**
		 * Removes a field from the list. Expects an ID/name as parameter
		 *
		 * @param string $fieldName
		 */
		public function removeField($fieldName)
		{
			unset($this->fields[$fieldName]);
		}
		
		/**
		 * Sets table name
		 *
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}
		
		/**
		 * Sets table collation
		 *
		 * @param string $collation
		 */
		public function setCollation($collation)
		{
			$this->collation = $collation;
		}
		
		/**
		 * Sets table definition/comments
		 *
		 * @param string $comments
		 */
		public function setComments($comments)
		{
			$this->comments = $comments;
		}
		
		/**
		 * Sets table data storage engine
		 *
		 * @param string $engine
		 */
		public function setEngine($engine)
		{
			$this->engine = $engine;
		}
		
		/**
		 * Sets a field as Primary Key. Expects a name/ID
		 *
		 * @param string $primaryKey
		 */
		public function setPrimaryKey($primaryKey)
		{
			if(array_key_exists($primaryKey, $this->fields))
				$this->primaryKey = $primaryKey;
		}
		
		/**
		 * Adds a field to the indexes list, if name/ID is present in fields list
		 *
		 * @param string $field
		 */
		public function addIndex($field)
		{
			if(array_key_exists($field, $this->fields))
				$this->indexes[] = $field;
		}
		
		/**
		 * Adds a field to the unique indexes list, if name/ID is present in fields list
		 *
		 * @param string $field
		 */
		public function addUnique($field)
		{
			if(array_key_exists($field, $this->fields))
				$this->uniques[] = $field;
		}
		
		/**
		 * Adds a field to the fulltexts indexes list, if name/ID is present in fields list
		 *
		 * @param string $field
		 */
		public function addFullText($field)
		{
			if(array_key_exists($field, $this->fields) && $this->fields[$field] instanceof StringField)
				$this->fullTexts[] = $field;
		}

		/**
		 * Removes a field from the indexes list
		 *
		 * @param string $field
		 */
		public function removeIndex($field)
		{
			unset($this->indexes[$field]);
		}
		
		/**
		 * Removes a field from the unique indexes list
		 *
		 * @param string $field
		 */
		public function removeUnique($field)
		{
			unset($this->uniques[$field]);
		}
		
		/**
		 * Removes a field from the fulltext indexes list
		 *
		 * @param string $field
		 */
		public function removeFullText($field)
		{
			unset($this->fullTexts[$field]);
		}
	
	}

?>