<?php

namespace Roowix\Podkur;

use Roowix\Podkur\DataBaseConnect;

class Api
{
    public $tableName;
    public $method; // GET|POST|PUT|DELETE
    private $uri;
    private $studentsConnect;

    public function __construct($uri, $method, $tableName, $dbconn)
    {
        $this->tableName = $tableName;
        $this->method = $method;
        $this->uri = $uri;
        $this->studentsConnect = $dbconn;
    }

    public function run()
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                return $this->getAction();
            case 'POST':
                return $this->createAction();
            case 'PUT':
                return $this->updateAction();
            case 'DELETE':
                return $this->deleteAction();
            default:
                return null;
        }
    }

    private function getAction()
    {
        $students = $this->studentsConnect->takeAll();
        echo json_encode($students);
        return json_encode($students);
    }

    private function createAction()
    {
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $result = $this->studentsConnect->insert($_POST);
        echo json_encode($result);
        return json_encode($result);
    }

    private function deleteAction()
    {
        $inArray = explode("/", $this->uri);
        $idArray = array("id" => (int)$inArray[2]);     // здесь мы знаем, что нам придет 'localhost/api/${id}'
                                                        // но не должны знать, поэтому нужны регулярные выражения
        $result = $this->studentsConnect->delete($idArray);
        echo json_encode($result);
        return json_encode($result);
    }

    private function updateAction()
    {
        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $condition =  array('id' => $_POST['id']);

        $result = $this->studentsConnect->update($_POST, $condition);
        echo json_encode($result);
        return json_encode($result);
    }
}
