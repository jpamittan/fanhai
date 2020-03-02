<?php

namespace App\Services\Company;

use App\Model\Company;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class QueryCompanyService implements BaseServiceInterface
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getAllPaginatedRecords() : object
    {
        return $this->company->orderBy('created_at', 'desc')->paginate();
    }

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

    public function findByID(Request $request) : object
    {
        return $this->company->find($request->route('id'));
    }

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

    public function deleteById(Request $request) : bool
    {
        return $this->company->destroy($request->route('id'));
    }
}
