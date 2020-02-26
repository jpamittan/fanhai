<?php

namespace App\Services;

use Illuminate\Http\Request;

interface SMSServiceInterface
{
    public function sendSMS(Request $request) : object;
}
