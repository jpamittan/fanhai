<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Services\Employee\QueryEmployeeService;

class EmployeeController extends Controller
{
    private $queryEmployeeService;
  
    /**
     * Constructor
     *
     * @param \Services\Employee\QueryEmployeeService $queryEmployeeService
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
    public function index() : Object
    {
        try {
            $employees = $this->queryEmployeeService->getAllPaginatedRecords();

            return response()->json($employees, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request) : Object
    {
        try {
            $employee = $this->queryEmployeeService->create($request);

            return response()->json($employee, 201);
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
            $employee = $this->queryEmployeeService->findByID($id);

            return response()->json($employee, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request) : Object
    {
        try {
            $employee = $this->queryEmployeeService->udpateByID($request);

            return response()->json($employee, 200);
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
            $employee = $this->queryEmployeeService->deleteById($id);

            if($employee) {
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
