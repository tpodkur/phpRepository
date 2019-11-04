<?php

namespace Roowix\Podkur;

use Roowix\Podkur\DataBaseConnect;
use Roowix\Podkur\ResponseWriter;

class Api
{
    private $tableName;
    private $method; // GET|POST|PUT|DELETE
    private $uri;
    private $studentsConnect;
    private $response;

    public function __construct($uri, $method, $tableName, $dbconn, $response)
    {
        $this->tableName = $tableName;
        $this->method = $method;
        $this->uri = $uri;
        $this->studentsConnect = $dbconn;
        $this->response = $response;
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
        $this->response->write($students);
        return json_encode($students);
    }

    private function createAction()
    {
        $result = $this->studentsConnect->insert($_POST);
        $this->response->write($result);
        return json_encode($result);
    }

    private function deleteAction()
    {
        $inArray = explode("/", $this->uri);
        $idArray = array("id" => (int)$inArray[2]);     // здесь мы знаем, что нам придет 'localhost/api/${id}'
                                                        // но не должны знать, поэтому нужны регулярные выражения
        $result = $this->studentsConnect->delete($idArray);
        $this->response->write($result);
        return json_encode($result);
    }

    private function updateAction()
    {
        $condition =  array('id' => $_POST['id']);

        $result = $this->studentsConnect->update($_POST, $condition);
        $this->response->write($result);
        return json_encode($result);
    }
}
