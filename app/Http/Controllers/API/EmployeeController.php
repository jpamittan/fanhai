<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Employee\QueryEmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $queryEmployeeService;
  
    /**
     * Constructor
     *
     * @param \Services\Employee\QueryEmployeeService
     */
    public function __construct(QueryEmployeeService $queryEmployeeService)
    {
        $this->queryEmployeeService = $queryEmployeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->queryEmployeeService->getAllPaginatedRecords();

        return response()->json($employees, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = $this->queryEmployeeService->create($request);

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $employee = $this->queryEmployeeService->findByID($request);

        return response()->json($employee, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $employee = $this->queryEmployeeService->udpateByID($request);

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $employee = $this->queryEmployeeService->deleteById($request);

        if($employee) {
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
