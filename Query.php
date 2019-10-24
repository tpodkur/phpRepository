<?php

class Query{
	private $query;

	public function __construct($connection, $SQLquery){
		$this->query  = pg_query($connection, $SQLquery)
			or die('Ошибка запроса: ' . pg_last_error());
	}

	public function perform(){
		return $this->query;
	}

	public function __destruct(){
		pg_free_result($this->query);
	}
}

?>