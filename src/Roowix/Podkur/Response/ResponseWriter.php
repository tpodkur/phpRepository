<?php

namespace Roowix\Podkur\Response;

class ResponseWriter
{
    public function write($data)
    {
        echo json_encode($data);
    }
}