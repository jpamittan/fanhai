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
    public function initializeNotification(String $type = '') : object
    {
    	if (empty($type)) {
    		$notificationClass = "\\App\\Services\\Message\\EmailNotification";
    	} else {
    		$notificationClass = "\\App\\Services\\Message\\{$type}";
    	}

		return new $notificationClass;
    }
}