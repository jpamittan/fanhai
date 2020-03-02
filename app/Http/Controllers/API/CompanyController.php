<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Services\Company\QueryCompanyService;

class CompanyController extends Controller
{
    private $queryCompanyService;
  
    /**
     * Constructor
     *
     * @param \Services\Company\QueryCompanyService $queryCompanyService
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
        try {
            $companies = $this->queryCompanyService->getAllPaginatedRecords();

            return response()->json($companies, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request) : Object
    {
        try {
            $company = $this->queryCompanyService->create($request);

            return response()->json($company, 201);
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
            $company = $this->queryCompanyService->findByID($id);

            return response()->json($company, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request) : Object
    {
        try {
            $company = $this->queryCompanyService->udpateByID($request);

            return response()->json($company, 200);
        } catch(Exception $e) {s
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
            $company = $this->queryCompanyService->deleteById($id);

            if($company) {
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
