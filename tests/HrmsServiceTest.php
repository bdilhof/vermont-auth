<?php

namespace VermontDevelopment\Auth\Tests;

use VermontDevelopment\Auth\Facades\HrmsFacade as Hrms;
use Orchestra\Testbench\TestCase;

class HrmsServiceTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_employee_by_uid()
    {
        $response = Hrms::getEmployeeByUid('u3314');
        $this->assertArrayHasKey('uid', $response);
    }

}
