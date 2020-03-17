<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Model\Company;
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
    public function index(): Object
    {
        try {
            $companies = $this->queryCompanyService->getAllPaginatedRecords();
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }

        return response()->json($companies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request): Company
    {
        try {
            $company = $this->queryCompanyService->create($request);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }

        return $company;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): Company
    {
        try {
            $company = $this->queryCompanyService->findByID($id);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }

        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request): Company
    {
        try {
            $company = $this->queryCompanyService->udpateByID($request);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }

        return $company;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id): Object
    {
        try {
            $company = $this->queryCompanyService->deleteById($id);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }

        if ($company) {
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
