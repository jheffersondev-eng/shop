<?php

namespace App\Http\Dto\User;

class CreateUserDto extends UserDto
{
	private ?int $userIdCreate = null;

	public function __construct(string $email, string $password, bool $is_active = true)
	{
		parent::__construct($email, $password, $is_active);
	}

	public function getUserIdCreate(): ?int
	{
		return $this->userIdCreate;
	}

	public function setUserIdCreate(?int $userIdCreate): void
	{
		$this->userIdCreate = $userIdCreate;
	}
}