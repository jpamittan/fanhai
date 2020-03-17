<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Services\Message\QueryMessageService;
use App\Services\Message\Factories\NotificationFactory;

class MessageController extends Controller
{
    private $queryMessageService;
    private $emailMessageService;
    private $smsMessageService;

    /**
     * Constructor
     *
     * @param \Services\Message\QueryMessageService
     */
    public function __construct(QueryMessageService $queryMessageService)
    {
        $this->queryMessageService = $queryMessageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Object
    {
        try {
            $messages = $this->queryMessageService->getAllPaginatedRecords();

            return response()->json($messages, 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): Object
    {
        try {
            $message = $this->queryMessageService->findByID($id);

            return response()->json($message, 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Send a notification
     *
     * @param  \Illuminate\Http\MessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function send(MessageRequest $request): Object
    {
        try {
            $notificationFactory = new NotificationFactory();
            $notification = $notificationFactory->initializeNotification($request->type);
            if ($notification->send($request)) {
                $message = $this->queryMessageService->create($request);

                return response()->json($message, 200);
            } else {
                return response()->json(["message" => "Sending notification failed. Please try again."], 501);
            }
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }
}
