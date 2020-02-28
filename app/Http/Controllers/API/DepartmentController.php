<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Department\QueryDepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $queryDepartmentService;
  
    /**
     * Constructor
     *
     * @param \Services\Department\QueryDepartmentService
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
    public function index()
    {
        $departments = $this->queryDepartmentService->getAllPaginatedRecords();

        return response()->json($departments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = $this->queryDepartmentService->create($request);

        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $department = $this->queryDepartmentService->findByID($request);

        return response()->json($department, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $department = $this->queryDepartmentService->udpateByID($request);

        return response()->json($department, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $department = $this->queryDepartmentService->deleteById($request);

        if($department) {
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
