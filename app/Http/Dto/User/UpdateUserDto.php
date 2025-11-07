<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

class UpdateUserDto extends BaseDto
{
    private string $id;
    private string $email;
    private string $password;

    public function __construct(string $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }   
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}