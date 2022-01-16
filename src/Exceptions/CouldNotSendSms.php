<?php

namespace Zedox\LaravelDhiraaguSms\Exceptions;

use Exception;

class CouldNotSendSms extends Exception
{
    public static function serviceRespondedWithAnError(string $message, string $code = null): CouldNotSendSms
    {
        return new static('Dhiraagu Bulk Sms with an error: '.$message.' '.$code);
    }
}