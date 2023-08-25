<?php

namespace VermontDevelopment\Auth\Services;

use Illuminate\Support\Facades\Http;

class HrmsService
{
    private $serviceUrl;
    private $serviceKey;

    public function __construct()
    {
        $this->serviceUrl = config('hrms.url');
        $this->serviceKey = config('hrms.key');
    }

    public function getAllEmployees()
    {
        $response = Http::get($this->serviceUrl . 'employees', [
            'key' => $this->serviceKey
        ]);

        return $response->json()['employees'];
    }

    public function getEmployeeByUid($uid)
    {
        $response = Http::get($this->serviceUrl . 'employees', [
            'key' => $this->serviceKey,
            'uid' => $uid,
        ]);

        $employees = $response->json()['employees'];

        return count($employees) ? $employees[0] : null;
    }

}
