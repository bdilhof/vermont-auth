<?php

namespace VermontDevelopment\Auth\Services;

use VermontDevelopment\Auth\Classes\LdapConnection;

class LdapService
{

    public function makeConnection()
    {
        foreach (config('ldap.connections') as $config) {
            $connection = new LdapConnection($config);
            if ($connection->isConnected) return $connection->ldap;
        }

        return null;
    }

    public function isAuthenticated($username, $password)
    {
        if (($user = $this->getUserByUsername($username)) === false) {
            return false;
        }

        $isAuthenticated = @ldap_bind($this->makeConnection(), $user['dn'], $password);

        return (bool) $isAuthenticated;
    }

    public function isNotAuthenticated($username, $password)
    {
        return ! $this->isAuthenticated($username, $password);
    }

    public function getUserByUsername($username)
    {
        $search_status = @ldap_search(
            $this->makeConnection(),
            config('ldap.base_dn.users'),
            "(&(uid=" . $username . ")(objectClass=account))",
            array('dn', 'uid', 'description', 'ou')
        );

        if ($search_status === false) return false;
        $result = @ldap_get_entries($this->makeConnection(), $search_status);
        if ($result === false) return false;

        if (intval($result['count']) > 0) {

            $user['dn']   = $result[0]['dn'];
            $user['uid']  = $result[0]['uid'][0];
            $user['name'] = $result[0]['description'][0];

            if (array_key_exists('ou', $result[0])) {
                foreach ($result[0]['ou'] as $key => $value) {
                    if (is_numeric($key)) {
                        $user['ou-' . $value] = true;
                    }
                }
            }

        } else {
            return false;
        }

        return (trim((string) $user['dn']) == '') ? false : $user;
    }

}
