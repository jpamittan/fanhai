<?php

namespace App\Services\Employee;

use App\Model\Employee;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class QueryEmployeeService implements BaseServiceInterface
{
    protected $employee;

    /**
     * Constructor
     *
     * @param App\Model\Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get paginated emplopyee data
     *
     * @return object
     */
    public function getAllPaginatedRecords() : object
    {
        return $this->employee->where('status', 1)->paginate();
    }

    /**
     * Create Employee
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function create(Request $request) : object
    {
        $employee = $this->employee->create([
            'department_id' => $request->input('department_id'),
            'fname' => $request->input('fname'),
            'mname' => $request->input('mname'),
            'lname' => $request->input('lname'),
            'position' => $request->input('position')
        ]);

        return $employee;
    }

    /**
     * Get Employee by Id
     *
     * @param int $id
     * @return object
     */
    public function findByID(int $id) : object
    {
        return $this->employee->where('department_id', $id)
            ->join('phonebook', 'employee.id', '=', 'phonebook.employee_id')
            ->get();
    }

    /**
     * Update Employee by Id
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function udpateByID(Request $request) : object
    {
        $employee = $this->employee->find($request->route('id'));
        if($request->input('department_id')) {
            $employee->department_id = $request->input('department_id');
        }
        if($request->input('fname')) {
            $employee->fname = $request->input('fname');
        }
        if($request->input('mname')) {
            $employee->mname = $request->input('mname');
        }
        if($request->input('lname')) {
            $employee->lname = $request->input('lname');
        }
        if($request->input('position')) {
            $employee->position = $request->input('position');
        }
        if($request->input('status')) {
            $employee->status = $request->input('status');
        }
        $employee->save();

        return $employee;
    }

    /**
     * Disable Employee by Id
     *
     * @param int $id
     * @return object
     */
    public function deleteById(int $id) : bool
    {
        return $this->employee->where('id', $id)
        ->where('status', 1)
        ->update(['status' => 0]);
    }
}
