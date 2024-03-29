<?php

namespace Roowix\Podkur\DB;

use Roowix\Podkur\Models\EntityStorageInterface;

class DB implements EntityStorageInterface
{
    private $dbconn;
    /** @var string */
    private $tableName;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst")
            or die('Не удалось соединиться: ' . pg_last_error());
        $this->tableName = 'students';
    }

    public function takeAll()
    {
        $query  = pg_query($this->dbconn, "SELECT * FROM students");
        $students = array();
        while ($row = pg_fetch_row($query)) {
            // !частная реализация для students
            $students[] = array("firstname" => $row[0], "lastname" => $row[1], "id" => $row[2]);
        }
        return $students;
    }

    public function insert(array $fields)
    {
   // !частная реализация для students
        $student = array("firstname" => $fields["firstName"], "lastname" => $fields["lastName"]);
        $result = pg_insert($this->dbconn, $this->tableName, $student);

        if ($result == false) {
            return false;
        }
        return $student;
    }

    public function delete(array $filter)
    {
        if ("integer" != gettype($filter)) {
            return false;
        }

        $delStr = pg_select($this->dbconn, $this->tableName, $filter);
        $result = pg_delete($this->dbconn, $this->tableName, $delStr[0]);
        if ($result == false) {
            return false;
        }
        return $delStr;
    }

    public function update(array $fields, array $filter)
    {
        $result = pg_update($this->dbconn, $this->tableName, $fields, $filter);
        if ($result == false) {
            return false;
        }
        return $fields;
    }

    public function __destruct()
    {
        pg_close($this->dbconn);
    }
}
