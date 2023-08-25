<?php

namespace VermontDevelopment\Auth\Facades;

use \Illuminate\Support\Facades\Facade;

class LdapFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'ldap';
    }
}
