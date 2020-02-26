<?php

namespace App\Services;

use Illuminate\Http\Request;

interface EmailServiceInterface
{
    public function sendMail(Request $request) : object;
}
