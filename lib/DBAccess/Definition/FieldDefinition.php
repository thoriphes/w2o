<?php
	/**
	 * This class represents a table field structure.
	 * 
	 * @author Nacho Roca <nacho@devnull.es>
	 * @copyright /dev/null S.L. <http://www.devnull.es>
	 * @version 0.1
	 * @package DBAccess
	 * @subpackage Definition
	 */
	abstract class FieldDefinition
	{
		/**
		 * String used for representing a field storing CURRENT_TIMESTAMP
		 *
		 */
		const TIMESTAMP = "TIMESTAMP";
		
		/**
		 * STRING for representing SQL NULL
		 *
		 */
		const NULL		= "NULL";
		
		/**
		 * Default field Collation
		 *
		 */
		const DEFAULT_COLLATION = "utf8_general_ci";
		
		/**
		 * Field name
		 *
		 * @var string
		 */
		public $name;
		
		/**
		 * Field type (STRING, INT, FLOAT, etc...)
		 *
		 * @var string
		 */
		public $type;
		
		/**
		 * Default value
		 *
		 * @var string
		 */
		public $default;
		
		/**
		 * Field length. In case float values, size is specified as INT_PART_LENGTH,DECIMAL_PART_LENGTH
		 *
		 * @var string
		 */
		public $length;
		
		/**
		 * Array of possible values in case of a SELECT type field
		 *
		 * @var array
		 */
		public $possibleValues;
		
		/**
		 * Field collation. Defaults to UTF-8
		 *
		 * @var string
		 */
		public $collation = self::DEFAULT_COLLATION;
		
		/**
		 * Flag for Binary Fields. Defaults to false
		 *
		 * @var boolean
		 */
		public $binary = false;
		
		/**
		 * Unsigned flasg for integer and float fields. Defaults to false
		 *
		 * @var boolean
		 */
		public $unsigned = false;
		
		/**
		 * Flag for filling the field with CURRENT_TIMESTAMP each time a row is modified. Defaults to false
		 *
		 * @var boolean
		 */
		public $isModificationTimeStamp = false;
		
		/**
		 * Required flag. Defaults to false
		 *
		 * @var boolean
		 */
		public $required = false;
		
		/**
		 * Auto increment flag. Defaults to false
		 *
		 * @var boolean
		 */
		public $autoIncrement = false;
		
		/**
		 * Field comments
		 *
		 * @var string
		 */
		public $comments = false;
		
		/**
		 * Sets field name
		 *
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}
		
		/**
		 * Sets field length. In case float values, size is specified as INT_PART_LENGTH,DECIMAL_PART_LENGTH.
		 * This function also resets the $possibleValues the field might have.
		 *
		 * @param string $size
		 */
		public function setSize($size)
		{
			if(is_numeric(str_replace(",",".",$size)) || is_null($size))
			{
				$this->length = $size;
				$this->possibleValues = null;
			}
		}
		
		/**
		 * Sets field type
		 *
		 * @param string$type
		 */
		public function setType($type)
		{
			$this->type = $type;
		}
		
		/**
		 * Sets default field value
		 *
		 * @param string $default
		 */
		public function setDefault($default)
		{
			$this->default = $default;
		}
		
		/**
		 * Flags the field default value as CURRENT_TIMESTAMP
		 *
		 */
		public function setDefaultTimeStamp()
		{
			$this->setDefault(self::TIMESTAMP);
		}
		
		/**
		 * Sets an array of valid values for the field. This function resets the field
		 * length value.
		 *
		 * @param array $values
		 */
		public function setPossibleValues(array $values)
		{
			$this->possibleValues = $values;
			$this->length = null;
		}
		
		/**
		 * Sets field collation
		 *
		 * @param string $collation
		 */
		public function setCollation($collation)
		{
			$this->collation = $collation;
		}
		
		/**
		 * Flags the field to store data in binary format. If called without parameters
		 * will set it to TRUE
		 *
		 * @param boolean $mode
		 */
		public function setBinary($mode = true)
		{
			$this->binary = $mode;
		}
		
		/**
		 * Flags a numerical field to store data unsigned. If called without parameters
		 * will set it to TRUE
		 *
		 * @param boolean $mode
		 */
		public function setUnsigned($mode = true)
		{
			$this->unsigned = $mode;
		}
		
		/**
		 * Flags a field to store CURRENT_TIMESTAMP on row modification. If called without parameters
		 * will set it to TRUE 
		 *
		 * @param boolean $mode
		 */
		public function setAsModificationTimeStamp($mode = true)
		{
			$this->isModificationTimeStamp = $mode;
		}
		
		/**
		 * Flags a field as required. If called without parameters
		 * will set it to TRUE 
		 *
		 * @param boolean $mode
		 */
		public function setRequired($mode = true)
		{
			$this->required = $mode;
		}
	
		/**
		 * Flags a field as auto_increment. If called without parameters
		 * will set it to TRUE 
		 *
		 * @param boolean $mode
		 */
		public function setAutoIncrement($mode = true)
		{
			$this->autoIncrement = $mode;
		}
		
		/**
		 * Sets field comments
		 *
		 * @param string $comments
		 */
		public function setComments($comments)
		{
			$this->comments = $comments;
		}
	}

?>