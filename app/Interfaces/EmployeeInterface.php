<?php

namespace App\Interfaces;

interface EmployeeInterface
{
    public function getAllEmployees($searchEmployeeID = null, $searchEmployeeCode = null, $searchEmployeeName = null, $searchEmailAddress = null);

    public function getDownloadEmployees($searchEmployeeID = null, $searchEmployeeCode = null, $searchEmployeeName = null, $searchEmailAddress = null);

    public function getEmployeeById($id);

    public function count();
}
