<?php

namespace App\Http\Dto\Client;

/**
 * Deprecated compatibility DTO. Use App\Http\Dto\UserDetail\CreateClientDto instead.
 */
class CreateClientDto
{
    public function __construct(...$args)
    {
        throw new \RuntimeException('App\\Http\\Dto\\Client\\CreateClientDto is deprecated. Use App\\Http\\Dto\\UserDetail\\CreateClientDto instead.');
    }
}
