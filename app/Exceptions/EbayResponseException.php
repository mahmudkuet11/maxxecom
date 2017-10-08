<?php

namespace App\Exceptions;


use Throwable;

class EbayResponseException extends \Exception
{
    public function __construct($response = "", $code = 0, Throwable $previous = null)
    {
        $error_messages = $this->parseErrors($response);
        $message = json_encode($error_messages);
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function parseErrors($response){
        $error_messages = [];
        foreach ($response->Errors as $error){
            $error_messages[] = (string)$error->LongMessage;
        }
        return $error_messages;
    }
}