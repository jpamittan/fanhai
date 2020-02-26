<?php

namespace App\Services\Message;

use App\Model\Message;
use App\Services\EmailServiceInterface;
use App\Services\SMSServiceInterface;
use Illuminate\Http\Request;

class MessageService implements EmailServiceInterface, SMSServiceInterface
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getAllPaginatedRecords() : object
    {
        return $this->message->paginate();
    }

    public function sendMail(Request $request) : object
    {
        //Create logic for sending email

        return $this->store($request);
    }

    public function sendSMS(Request $request) : object
    {
        //Create logic for sending sms

        return $this->store($request);
    }

    public function store(Request $request) : object
    {
        $message = $this->message->create([
            'employee_id' => $request->input('employee_id'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact')
        ]);

        return $message;
    }

    public function findByID(Request $request) : object
    {
        return $this->message->find($request->route('id'));
    }
}
