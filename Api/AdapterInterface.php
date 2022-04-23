<?php

declare(strict_types=1);

namespace PerfectCode\ConnectionButton\Api;

interface AdapterInterface
{
    /**
     * Verify if connection with the endpoint persists.
     *
     * @return bool
     */
    public function authenticate(): bool;
}
