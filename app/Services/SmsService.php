<?php

namespace App\Services;

class SmsService
{

    public static function build()
    {
        return (new self);
    }

    public function Send()
    {
        // handle send sms
    }
}
