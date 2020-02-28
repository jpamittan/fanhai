<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Message\QueryMessageService;
use App\Services\Message\EmailMessageService;
use App\Services\Message\SMSMessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $queryMessageService;
    private $emailMessageService;
    private $smsMessageService;
  
    /**
     * Constructor
     *
     * @param \Services\Message\QueryMessageService
     * @param \Services\Message\EmailMessageService
     * @param \Services\Message\SMSMessageService
     */
    public function __construct(QueryMessageService $queryMessageService, EmailMessageService $emailMessageService, SMSMessageService $smsMessageService)
    {
        $this->queryMessageService = $queryMessageService;
        $this->emailMessageService = $emailMessageService;
        $this->smsMessageService = $smsMessageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->queryMessageService->getAllPaginatedRecords();

        return response()->json($messages, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $message = $this->queryMessageService->findByID($request);

        return response()->json($message, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Request $request)
    {
        if($this->emailMessageService->sendMail($request)) {
            $request->request->add(['type' => 'email']);
            $message = $this->queryMessageService->create($request);

            return response()->json($message, 201);
        } else {
            return response()->json([
                "msg" => "An error has occured. Please try again."
            ], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendSMS(Request $request)
    {
        if($this->smsMessageService->sendSMS($request)) {
            $request->request->add(['type' => 'sms']);
            $message = $this->queryMessageService->create($request);

            return response()->json($message, 201);
        } else {
            return response()->json([
                "msg" => "An error has occured. Please try again."
            ], 501);
        }
    }
}
