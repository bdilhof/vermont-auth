<?php

return [

    'opt_protocol_version' => (int) env('LDAP_OPT_PROTOCOL_VERSION', 3),

    'connections' => [

        'primary' => [
            'host' => env('LDAP_CONNECTIONS_PRIMARY_HOST', ''),
            'port' => (int) env('LDAP_CONNECTIONS_PRIMARY_PORT', 389),
            'tls' => env('LDAP_CONNECTIONS_PRIMARY_TLS', true),
            'dn' => env('LDAP_CONNECTIONS_PRIMARY_DN', ''),
            'password' => env('LDAP_CONNECTIONS_PRIMARY_PASSWORD', ''),
        ],

        'secondary' => [
            'host' => env('LDAP_CONNECTIONS_SECONDARY_HOST', ''),
            'port' => (int) env('LDAP_CONNECTIONS_SECONDARY_PORT', 389),
            'tls' => env('LDAP_CONNECTIONS_SECONDARY_TLS', true),
            'dn' => env('LDAP_CONNECTIONS_SECONDARY_DN', ''),
            'password' => env('LDAP_CONNECTIONS_SECONDARY_PASSWORD', ''),
        ],

    ],

    'base_dn' => [
        'users' => env('LDAP_BASE_DN_USERS')
    ],

];
