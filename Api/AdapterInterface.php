<?php

declare(strict_types=1);

namespace PerfectCode\ConnectionButton\Api;

/**
 * Example of implementation:
 *
 * $this->request->getParam('basic_auth_user') // here is the key from di.xml
 * $this->scopeConfig->getValue('section/group/field') // can be used for retrieving password values
 *      as on the frontend and in request object they are viewing as '******'
 *
 * if ($this->request->getParam('basic_auth_pass') === '******') {
 *     $value = $this->scopeConfig->getValue('section/group/password');
 * } else {
 *     $value = $this->request->getParam('basic_auth_pass');
 * }
 */
interface AdapterInterface
{
    /**
     * Verify if connection with the endpoint persists.
     *
     * @return bool
     */
    public function authenticate(): bool;
}
