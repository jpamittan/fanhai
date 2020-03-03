<?php

namespace App\Services\Phonebook;

use App\Model\Phonebook;
use App\Services\QueryInterface;
use Illuminate\Http\Request;

class QueryPhonebookService implements QueryInterface
{
    protected $phonebook;

    /**
     * Constructor
     *
     * @param App\Model\Phonebook $company
     */
    public function __construct(Phonebook $phonebook)
    {
        $this->phonebook = $phonebook;
    }

    /**
     * Get paginated phonebook data
     *
     * @return object
     */
    public function getAllPaginatedRecords() : object
    {
        return $this->phonebook->paginate();
    }

    /**
     * Create Phonebook
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function create(Request $request) : object
    {
        $phonebook = $this->phonebook->create([
            'employee_id' => $request->input('employee_id'),
            'address' => $request->input('address'),
            'work_email' => $request->input('work_email'),
            'email' => $request->input('email'),
            'home_phone' => $request->input('home_phone'),
            'work_phone' => $request->input('work_phone'),
            'mobile_phone' => $request->input('mobile_phone')
        ]);

        return $phonebook;
    }

    /**
     * Get Phonebook by Id
     *
     * @param int $id
     * @return object
     */
    public function findByID(int $id) : ?object
    {
        return $this->phonebook->find($id);
    }

    /**
     * Update Phonebook by Id
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function udpateByID(Request $request) : object
    {
        $phonebook = $this->phonebook->find($request->route('id'));

        if($request->input('employee_id')) {
            $phonebook->employee_id = $request->input('employee_id');
        }
        if($request->input('address')) {
            $phonebook->address = $request->input('address');
        }
        if($request->input('work_email')) {
            $phonebook->work_email = $request->input('work_email');
        }
        if($request->input('email')) {
            $phonebook->email = $request->input('email');
        }
        if($request->input('home_phone')) {
            $phonebook->home_phone = $request->input('home_phone');
        }
        if($request->input('work_phone')) {
            $phonebook->work_phone = $request->input('work_phone');
        }
        if($request->input('mobile_phone')) {
            $phonebook->mobile_phone = $request->input('mobile_phone');
        }
        $phonebook->save();

        return $phonebook;
    }

    /**
     * Delete Phonebook by Id
     *
     * @param int $id
     * @return object
     */
    public function deleteById(int $id) : bool
    {
        return $this->phonebook->destroy($id);
    }
}
