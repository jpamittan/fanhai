<?php

namespace App\Services\Company;

use App\Model\Company;
use App\Services\QueryInterface;
use Illuminate\Http\Request;

class QueryCompanyService implements QueryInterface
{
    protected $company;

    /**
     * Constructor
     *
     * @param App\Model\Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Get paginated company data
     *
     * @return object
     */
    public function getAllPaginatedRecords() : object
    {
        return $this->company->orderBy('created_at', 'desc')->paginate();
    }

    /**
     * Create Company
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function create(Request $request) : object
    {
        $company = $this->company->create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'logo' => $request->input('logo')
        ]);

        return $company;
    }

    /**
     * Get Company by Id
     *
     * @param int $id
     * @return object
     */
    public function findByID(int $id) : ?object
    {
        return $this->company->find($id);
    }

    /**
     * Update Company by Id
     *
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function udpateByID(Request $request) : object
    {
        $company = $this->company->find($request->route('id'));

        if($request->input('name')) {
            $company->name = $request->input('name');
        }
        if($request->input('address')) {
            $company->address = $request->input('address');
        }
        if($request->input('email')) {
            $company->email = $request->input('email');
        }
        if($request->input('contact')) {
            $company->contact = $request->input('contact');
        }
        if($request->input('logo')) {
            $company->logo = $request->input('logo');
        }
        $company->save();

        return $company;
    }

    /**
     * Delete Company by Id
     *
     * @param int $id
     * @return object
     */
    public function deleteById(int $id) : bool
    {
        return $this->company->destroy($id);
    }
}
