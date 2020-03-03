<?php

namespace App\Services;

use Illuminate\Http\Request;

interface NotificationInterface
{
    public function send(Request $request) : bool;
}
