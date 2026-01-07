<?php

namespace App\Services;

class ServiceResult
{
    public function __construct(
        public bool $success,
        public mixed $data = null,
        public string|null $message = null,
        public string|null $route = null
    ) {}
    
    public static function ok(mixed $data = null, string|null $message = null, string|null $route = null): self
    {
        return new self(true, $data, $message, $route);
    }

    public static function fail(string $message): self
    {
        return new self(false, null, $message);
    }
}