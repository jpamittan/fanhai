<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Services\Department\QueryDepartmentService;

class DepartmentController extends Controller
{
    private $queryDepartmentService;
  
    /**
     * Constructor
     *
     * @param \Services\Department\QueryDepartmentService $queryDepartmentService
     */
    public function __construct(QueryDepartmentService $queryDepartmentService)
    {
        $this->queryDepartmentService = $queryDepartmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : Object
    {
        try {
            $departments = $this->queryDepartmentService->getAllPaginatedRecords();

            return response()->json($departments, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DepartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request) : Object
    {
        try {
            $department = $this->queryDepartmentService->create($request);

            return response()->json($department, 201);
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
            $department = $this->queryDepartmentService->findByID($id);

            return response()->json($department, 200);
        } catch(Exception $e) {
            return response()->json(["message" => $e->getMessage()], 501);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DepartmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request) : Object
    {
        try {
            $department = $this->queryDepartmentService->udpateByID($request);

            return response()->json($department, 200);
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
            $department = $this->queryDepartmentService->deleteById($id);

            if($department) {
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
