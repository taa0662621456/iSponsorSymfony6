<?php

namespace App\Model;

class ErrorResponseModel
{
    private mixed $error;

    /**
     * @return mixed
     */
    public function getError(): mixed
    {
        return $this->error;
    }



}