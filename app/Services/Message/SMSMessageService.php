<?php

namespace App\Services\Message;

use App\Services\SMSServiceInterface;
use Illuminate\Http\Request;

class SMSMessageService implements SMSServiceInterface
{
    public function sendSMS(Request $request) : bool
    {
        try {
			$ch = curl_init();
			$itexmo = array(
				'1' => $request->input('mobile'),
				'2' => $request->input('msg'),
				'3' => env('ITEXTMO_API_KEY')
			);
			curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 
			http_build_query($itexmo));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_exec ($ch);
			curl_close ($ch);
			return true;
        } catch(xception $e) {
        	return false;
        }
    }
}
