<?php

namespace App\Http\Dto\User;

class UpdateUserDto extends UserDto
{
	private int $id;

	public function __construct(int $id, string $email, string $password, bool $is_active = true)
	{
		parent::__construct($email, $password, $is_active);
		$this->id = $id;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function getUpdatedBy(): int
	{
		return $this->id;
	}

	public function setUpdatedBy(int $id): void
	{
		$this->id = $id;
	}
}