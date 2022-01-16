<?php

namespace Zedox\LaravelDhiraaguSms\Exceptions;

use Exception;

class CouldNotUseSmsService extends Exception
{
    public static function invalidRecipient(): CouldNotUseSmsService
    {
        return new static('Invalid mobile number provided');
    }

    public static function missingCredentials(): CouldNotUseSmsService
    {
        return new static('Missing credentials for Dhiraagu Sms. Are you sure you have set the credentials in your config/services.php file?');
    }
}