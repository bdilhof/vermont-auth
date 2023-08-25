<?php

namespace VermontDevelopment\Auth\Helpers;

class Vermont
{
    /**
     * @param $value
     *
     * @return bool
     */
    public function isLdapUCode($value): bool
    {
        $pattern = '/^u\d{4,5}$/';
        preg_match($pattern, $value, $matches);

        return (bool) $matches;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function isNotLdapUCode($value): bool
    {
        return ! $this->isLdapUCode($value);
    }

}
