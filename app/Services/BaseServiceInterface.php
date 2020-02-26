<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    public function getAllPaginatedRecords() : object;
    public function create(Request $request) : object;
    public function findByID(Request $request) : object;
    public function udpateByID(Request $request) : object;
    public function deleteById(Request $request) : bool;
}
