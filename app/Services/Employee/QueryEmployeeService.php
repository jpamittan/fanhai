<?php

namespace App\Services\Employee;

use App\Model\Employee;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class QueryEmployeeService implements BaseServiceInterface
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getAllPaginatedRecords() : object
    {
        return $this->employee->where('status', 1)->paginate();
    }

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

    public function findByID(Request $request) : object
    {
        return $this->employee->where('department_id', $request->route('id'))
            ->join('phonebook', 'employee.id', '=', 'phonebook.employee_id')
            ->get();
    }

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
        $employee->save();

        return $employee;
    }

    public function deleteById(Request $request) : bool
    {
        return $this->employee->where('id', $request->route('id'))
        ->where('status', 1)
        ->update(['status' => 0]);
    }
}
