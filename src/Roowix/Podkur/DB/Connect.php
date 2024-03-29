<?php

namespace Roowix\Podkur\DB;

class Connect
{
    private $connection;

    public function __construct(string $connection_string)
    {
        $this->connection = pg_connect($connection_string)
            or die('Не удалось соединиться: ' . pg_last_error());
    }

    public function getConnect()
    {
        // global($connection);
        return $this->connection;
    }

    public function __destruct()
    {
        pg_close($this->connection);
    }
}
