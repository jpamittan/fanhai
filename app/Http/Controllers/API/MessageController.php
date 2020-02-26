<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Message\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $messageService;
  
    /**
     * Constructor
     *
     * @param \Services\Phonebook\PhonebookService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messageService->getAllPaginatedRecords();

        return response()->json($messages, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        $message = $this->messageService->sendMail($request);

        return response()->json($message, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendSMS(Request $request)
    {
        $message = $this->messageService->sendSMS($request);

        return response()->json($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $message = $this->messageService->findByID($request);

        return response()->json($message, 200);
    }
}
