<?php

namespace Classes;

class Connection{
	private $connection;

	public function __construct($connection_string){
		$this->connection = pg_connect($connection_string)
			or die('Не удалось соединиться: ' . pg_last_error());
	}

	public function getConnect(){
		// global($connection);
		return $this->connection;
	}

	public function __destruct(){
		pg_close($this->connection);
	}
}
