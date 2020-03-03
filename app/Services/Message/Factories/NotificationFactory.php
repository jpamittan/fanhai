<?php

namespace App\Services\Message\Factories;

use App\Services\Message\EmailNotification;
use App\Services\Message\SMSNotification;

class NotificationFactory
{
	/**
     * Initialize notification method
     *
     * @param String $type
     * @return object
     */
    public function initializeNotification(String $type) : object
    {
        switch (strtolower($type)) {
		    case "email":
		        return new EmailNotification();
		        break;
		    case "sms":
		        return new SMSNotification();
		        break;

		    default:
		        throw new Exception("Unsupported notification method.");
		}
    }
}