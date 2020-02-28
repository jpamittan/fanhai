<?php

namespace App\Services;

use Illuminate\Http\Request;

interface MessageServiceInterface
{
    public function getAllPaginatedRecords() : object;
    public function create(Request $request) : object;
    public function findByID(Request $request) : object;
}
