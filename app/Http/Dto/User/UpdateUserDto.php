<?php

namespace App\Http\Dto\User;

class UpdateUserDto extends UserDto
{
	private int $id;
    private string $email;
    private ?string $password = null;
    private int $profile_id;
    private bool $is_active;

    public function __construct(int $id, string $email, int $profile_id, bool $is_active = true)
    {
        $this->id = $id;
        $this->email = $email;
        $this->profile_id = $profile_id;
        $this->is_active = $is_active;
    }

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
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