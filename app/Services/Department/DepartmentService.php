<?php

namespace App\Services\Department;

use App\Model\Department;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class DepartmentService implements BaseServiceInterface
{
    protected $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function getAllPaginatedRecords() : object
    {
        return $this->department->paginate();
    }

    public function create(Request $request) : object
    {
        $department = $this->department->create([
            'company_id' => $request->input('company_id'),
            'name' => $request->input('name')
        ]);

        return $department;
    }

    public function findByID(Request $request) : object
    {
        return $this->department->find($request->route('id'));
    }

    public function udpateByID(Request $request) : object
    {
        $department = $this->department->find($request->route('id'));
        if($request->input('name')) {
            $department->name = $request->input('name');
        }
        $department->save();

        return $department;
    }

    public function deleteById(Request $request) : bool
    {
        return $this->department->destroy($request->route('id'));
    }
}
