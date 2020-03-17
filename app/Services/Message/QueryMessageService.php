<?php

namespace App\Services\Message;

use App\Model\Message;
use Illuminate\Http\Request;

class QueryMessageService
{
    protected $message;

    /**
     * Constructor
     *
     * @param App\Model\Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get paginated message data
     *
     * @return object
     */
    public function getAllPaginatedRecords(): object
    {
        return $this->message->paginate();
    }

    /**
     * Create a message
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function create(Request $request): object
    {
        $message = $this->message->create([
            'to' => $request->input('to'),
            'title' => $request->input('title'),
            'msg' => $request->input('msg'),
            'type' => $request->input('type')
        ]);

        return $message;
    }

    /**
     * Get message by Id
     *
     * @param int $id
     * @return object
     */
    public function findByID(int $id): ?object
    {
        return $this->message->find($id);
    }
}
