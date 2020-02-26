<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Phonebook\PhonebookService;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    private $phonebookService;
  
    /**
     * Constructor
     *
     * @param \Services\Phonebook\PhonebookService
     */
    public function __construct(PhonebookService $phonebookService)
    {
        $this->phonebookService = $phonebookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phonebooks = $this->phonebookService->getAllPaginatedRecords();

        return response()->json($phonebooks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phonebook = $this->phonebookService->create($request);

        return response()->json($phonebook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $phonebook = $this->phonebookService->findByID($request);

        return response()->json($phonebook, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $phonebook = $this->phonebookService->udpateByID($request);

        return response()->json($phonebook, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $phonebook = $this->phonebookService->deleteById($request);

        if($phonebook) {
            return response()->json([
                "msg" => "Record deleted successfully."
            ], 200);
        } else {
            return response()->json([
                "msg" => "No record to be deleted."
            ], 404);
        }
    }
}
