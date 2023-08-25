<?php

namespace VermontDevelopment\Auth\Tests;

use Orchestra\Testbench\TestCase;
use VermontDevelopment\Auth\Facades\LdapFacade as Ldap;
use VermontDevelopment\Auth\Providers\AuthServiceProvider;

class LdapServiceTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [AuthServiceProvider::class];
    }

    public function test_connection_can_be_established()
    {
        $connection = Ldap::makeConnection();
        $this->assertTrue(gettype($connection) === 'resource');
    }

}
