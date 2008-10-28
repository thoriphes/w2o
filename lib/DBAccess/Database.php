<?php

	class Database {
		
		const LOCALHOST = "localhost";
		
		protected 
			$name,
			$host = self::LOCALHOST,
			$user,
			$pass;
		
		/**
		 * Sets up database name and host
		 *
		 * @param string $name
		 * @param string $host
		 */
		public function __construct($name, $user, $pass, $host = self::LOCALHOST)
		{
			$this->setName($name);
			$this->setHost($host);
			$this->setUser($user);
			$this->setPass($pass);
		}
		
		/**
		 * Sets database name
		 *
		 * @param string $name
		 */
		public function setName($name)
		{
			$this->name = $name;
		}
		
		/**
		 * Sets database host
		 *
		 * @param string $host
		 */
		public function setHost($host = self::LOCALHOST)
		{
			$this->host = $host;
		}
	
		public function setUser($username)
		{
			$this->user = $username;
		}
		
		public function setPass($password)
		{
			$this->pass = $password;
		}
		
		/**
		 * Returns database name
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}
		
		/**
		 * Returns database host
		 *
		 * @return string
		 */
		public function getHost()
		{
			return $this->host;
		}
		
		public function getUser()
		{
			return $this->user;
		}
		
		public function getPass()
		{
			return $this->pass;
		}
	}

?>