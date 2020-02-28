<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Company\QueryCompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $queryCompanyService;
  
    /**
     * Constructor
     *
     * @param \Services\Company\QueryCompanyService
     */
    public function __construct(QueryCompanyService $queryCompanyService)
    {
        $this->queryCompanyService = $queryCompanyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : Object
    {
        $companies = $this->queryCompanyService->getAllPaginatedRecords();

        return response()->json($companies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Object
    {
        $company = $this->queryCompanyService->create($request);

        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) : Object
    {
        $company = $this->queryCompanyService->findByID($request);

        return response()->json($company, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) : Object
    {
        $company = $this->queryCompanyService->udpateByID($request);

        return response()->json($company, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) : Object
    {
        $company = $this->queryCompanyService->deleteById($request);

        if($company) {
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
