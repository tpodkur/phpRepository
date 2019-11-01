<?php

namespace Roowix\Podkur;

require_once 'Connect.php';
require_once 'Query.php';

class MyApi
{
    private $connectString = "host=localhost port=5432 dbname=postgres user=postgres password=iebdkst";
    public $tableName = '';
    public $method = ''; //GET|POST|PUT|DELETE


    public function __construct()
    {
        $this->tableName = 'students';
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function run()
    {
        //echo $_SERVER['REQUEST_METHOD'];
        $method = $this->method;
        switch ($method) {
            case 'GET':
                $this->getAction();
                break;
            case 'POST':
                //echo "hello";
                $this->createAction();
                break;
            case 'PUT':
                $this->updateAction();
                break;
            case 'DELETE':
                $this->deleteAction();
                break;
            default:
                return null;
        }
    }

    private function getAction()
    {
        $studentsConnection = new Connect($this->connectString);
        $dbconn = $studentsConnection->getConnect();

        $query  = new Query($dbconn, "SELECT * FROM students");
        $result = $query->perform();

        $students = array();

        while ($row = pg_fetch_row($result)) {
            $students[] = array("firstname" => $row[0], "lastname" => $row[1], "id" => $row[2]);
        }

        echo json_encode($students);
    }

    private function createAction()
    {
        $studentsConnection = new Connect($this->connectString);
        $dbconn = $studentsConnection->getConnect();

        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $student = array("firstname" => $_POST["firstName"], "lastname" => $_POST["lastName"]);
        $result = pg_insert($dbconn, $this->tableName, $student);

        echo json_encode($result);
    }

    private function updateAction()
    {
        $studentsConnection = new Connect($this->connectString);
        $dbconn = $studentsConnection->getConnect();
        $condition =  array('id' => $_POST['id']);

        $result = pg_update($dbconn, $this->tableName, $_POST, $condition);
        echo json_encode($result);
    }

    private function deleteAction()
    {
        $studentsConnection = new Connect($this->connectString);
        $dbconn = $studentsConnection->getConnect();

        $inArray = explode("/", $_SERVER['REQUEST_URI']);
        $idArray = array("id" => (int)$inArray[2]);

        $delStr = pg_select($dbconn, $this->tableName, $idArray);

        $result = pg_delete($dbconn, $this->tableName, $delStr[0]);
        echo json_encode($result);
    }

}