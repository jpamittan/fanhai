<?php

namespace App\Services\Message;

use App\Model\Message;
use App\Services\MessageServiceInterface;
use Illuminate\Http\Request;

class QueryMessageService implements MessageServiceInterface
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

    public function create(Request $request) : object
    {
        $message = $this->message->create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'title' => $request->input('title'),
            'msg' => $request->input('msg'),
            'type' => $request->input('type')
        ]);

        return $message;
    }

    public function findByID(Request $request) : object
    {
        return $this->message->find($request->route('id'));
    }
}
