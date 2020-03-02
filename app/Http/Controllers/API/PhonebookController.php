<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhonebookRequest;
use App\Services\Phonebook\QueryPhonebookService;

class PhonebookController extends Controller
{
    private $queryPhonebookService;
  
    /**
     * Constructor
     *
     * @param \Services\Phonebook\QueryPhonebookService $queryPhonebookService
     */
    public function __construct(QueryPhonebookService $queryPhonebookService)
    {
        $this->queryPhonebookService = $queryPhonebookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : Object
    {
        try {
            $phonebooks = $this->queryPhonebookService->getAllPaginatedRecords();

            return response()->json($phonebooks, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PhonebookRequests $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhonebookRequest $request) : Object
    {
        try {
            $phonebook = $this->queryPhonebookService->create($request);

            return response()->json($phonebook, 201);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) : Object
    {
        try {
            $phonebook = $this->queryPhonebookService->findByID($id);

            return response()->json($phonebook, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PhonebookRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request) : Object
    {
        try {
            $phonebook = $this->queryPhonebookService->udpateByID($request);

            return response()->json($phonebook, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id) : Object
    {
        try {
            $phonebook = $this->queryPhonebookService->deleteById($id);

            if($phonebook) {
                return response()->json([
                    "msg" => "Record deleted successfully."
                ], 200);
            } else {
                return response()->json([
                    "msg" => "No record to be deleted."
                ], 404);
            }
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }
}
