<?php

namespace Roowix\Podkur;

class ResponseWriter
{
    public function write($data)
    {
        echo json_encode($data);
    }
}