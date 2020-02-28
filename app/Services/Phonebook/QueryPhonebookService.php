<?php

namespace App\Services\Phonebook;

use App\Model\Phonebook;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class QueryPhonebookService implements BaseServiceInterface
{
    protected $phonebook;

    public function __construct(Phonebook $phonebook)
    {
        $this->phonebook = $phonebook;
    }

    public function getAllPaginatedRecords() : object
    {
        return $this->phonebook->paginate();
    }

    public function create(Request $request) : object
    {
        $phonebook = $this->phonebook->create([
            'employee_id' => $request->input('employee_id'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact')
        ]);

        return $phonebook;
    }

    public function findByID(Request $request) : object
    {
        return $this->phonebook->find($request->route('id'));
    }

    public function udpateByID(Request $request) : object
    {
        $phonebook = $this->phonebook->find($request->route('id'));
        if($request->input('employee_id')) {
            $phonebook->employee_id = $request->input('employee_id');
        }
        if($request->input('email')) {
            $phonebook->email = $request->input('email');
        }
        if($request->input('contact')) {
            $phonebook->contact = $request->input('contact');
        }
        $phonebook->save();

        return $phonebook;
    }

    public function deleteById(Request $request) : bool
    {
        return $this->phonebook->destroy($request->route('id'));
    }
}
