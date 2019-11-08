<?php

namespace Roowix\Podkur;

use Roowix\Podkur\DB\DB;
use Roowix\Podkur\Models\EntityStorageInterface;
use Roowix\Podkur\Response\ResponseWriter;

class Api
{
    /** @var string */
    private $uri;
    /** @var ResponseWriter */
    private $response;
    /** @var DB */
    private $studentsConnect;


    public function __construct(DB $dbconn)
    {
        $this->studentsConnect = $dbconn;
    }

    public function run(string $uri, string $method, ResponseWriter $response)
    {
        $this->method = $method;
        $this->uri = $uri;

        switch ($method) {
            case 'GET':
                return $this->getAction();
            case 'POST':
                return $this->createAction();
            case 'PUT':
                return $this->updateAction();
            case 'DELETE':
                $inArray = explode("/", $this->uri);    // здесь мы знаем, что нам придет 'localhost/api/${id}'
                $idArray = ["id" => (int)$inArray[2]];
                return $this->deleteAction($idArray);
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

    private function deleteAction($id)
    {
        $result = $this->studentsConnect->delete($id);
        $this->response->write($result);
        return json_encode($result);
    }

    private function updateAction()
    {
        $filter = ["id" => $_POST["id"]];
        $result = $this->studentsConnect->update($_POST, $filter);
        $this->response->write($result);
        return json_encode($result);
    }
}
