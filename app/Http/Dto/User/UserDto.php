<?php

namespace App\Http\Dto\User;

use App\Http\Dto\BaseDto;

class UserDto extends BaseDto
{
    private string $email;
    private string $password;
    private int $profile_id;
    private bool $is_active;

    public function __construct(string $email, string $password, int $profile_id, bool $is_active = true)
    {
        $this->email = $email;
        $this->password = $password;
        $this->profile_id = $profile_id;
        $this->is_active = $is_active;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getProfileId(): int
    {
        return $this->profile_id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }
    
    public function setProfileId(int $profile_id): void
    {
        $this->profile_id = $profile_id;
    }
}