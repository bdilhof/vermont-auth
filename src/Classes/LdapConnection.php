<?php

namespace VermontDevelopment\Auth\Classes;

class LdapConnection
{
    public $ldap;

    public $isConnected;

    public function __construct($config)
    {
        $ldap = ldap_connect($config['host'], $config['port']);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, config('ldap.opt_protocol_version'));

        if ($config['tls'] AND $ldap !== false) ldap_start_tls($ldap);

        $this->ldap = $ldap;
        $this->isConnected = @ldap_bind($ldap, $config['dn'], $config['password']);
    }

}
