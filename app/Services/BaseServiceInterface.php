<?php

namespace App\Services;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    public function getAllPaginatedRecords() : object;
    public function create(Request $request) : object;
    public function findByID(int $id) : object;
    public function udpateByID(Request $request) : object;
    public function deleteById(int $id) : bool;
}
