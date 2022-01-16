<?php

namespace Zedox\LaravelDhiraaguSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool send(string $toMobile, string $message)
 *
 * @see \App\Services\DhiraaguSms
 */
class DhiraaguSms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dhiraagu-sms';
    }
}