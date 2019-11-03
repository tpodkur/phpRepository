<?php

namespace Roowix\Podkur;

require_once 'Connect.php';
require_once 'Query.php';

class MyApi
{
    public $tableName = '';
    public $method = ''; //GET|POST|PUT|DELETE


//    public function __construct()
//    {
//        $this->tableName = 'students';
//        $this->method = $_SERVER['REQUEST_METHOD'];
//    }

    public function __construct($method, $tableName)
    {
        $this->tableName = $tableName;
        $this->method = $method;
    }

    public function run($dbconn)
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                $this->getAction($dbconn);
                break;
            case 'POST':
                $this->createAction($dbconn);
                break;
            case 'PUT':
                $this->updateAction($dbconn);
                break;
            case 'DELETE':
                $this->deleteAction($dbconn);
                break;
            default:
                return null;
        }
    }

    private function getAction($dbconn)
    {
        $query  = new Query($dbconn, "SELECT * FROM students");
        $result = $query->perform();

        $students = array();

        while ($row = pg_fetch_row($result)) {
            $students[] = array("firstname" => $row[0], "lastname" => $row[1], "id" => $row[2]);
        }

        echo json_encode($students);
    }

    private function createAction($dbconn)
    {
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $student = array("firstname" => $_POST["firstName"], "lastname" => $_POST["lastName"]);
        $result = pg_insert($dbconn, $this->tableName, $student);

        echo json_encode($result);
    }

    private function deleteAction($dbconn)
    {
        $inArray = explode("/", $_SERVER['REQUEST_URI']);
        $idArray = array("id" => (int)$inArray[2]);

        $delStr = pg_select($dbconn, $this->tableName, $idArray);

        $result = pg_delete($dbconn, $this->tableName, $delStr[0]);
        echo json_encode($result);
    }

    private function updateAction($dbconn)
    {
        $condition =  array('id' => $_POST['id']);

        $result = pg_update($dbconn, $this->tableName, $_POST, $condition);
        echo json_encode($result);
    }

}