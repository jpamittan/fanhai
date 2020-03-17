<?php

namespace App\Services\Department;

use App\Model\Department;
use App\Services\QueryInterface;
use Illuminate\Http\Request;
use DB;

class QueryDepartmentService implements QueryInterface
{
    protected $department;

    /**
     * Constructor
     *
     * @param App\Model\Department $department
     */
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Get paginated employee data
     *
     * @return object
     */
    public function getAllPaginatedRecords(): object
    {
        return $this->department->paginate();
    }

    /**
     * Create Department
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function create(Request $request): object
    {
        $department = $this->department->create([
            'company_id' => $request->input('company_id'),
            'name' => $request->input('name')
        ]);

        return $department;
    }

    /**
     * Get Department by Id
     *
     * @param int $id
     * @return object
     */
    public function findByID(int $id): ?object
    {
        return $this->department->where('company_id', $id)->get();
    }

    /**
     * Update Department by Id
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function udpateByID(Request $request): object
    {
        $department = $this->department->find($request->route('id'));
        if ($request->input('company_id')) {
            $department->company_id = $request->input('company_id');
        }
        if ($request->input('name')) {
            $department->name = $request->input('name');
        }
        $department->save();

        return $department;
    }

    /**
     * Delete Department by Id
     *
     * @param int $id
     * @return object
     */
    public function deleteById(int $id): bool
    {
        return $this->department->destroy($id);
    }
}
