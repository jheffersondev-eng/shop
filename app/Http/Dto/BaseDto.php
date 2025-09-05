<?php

namespace App\Http\Dto;

abstract class BaseDto
{
	public function toArray(): array
	{
		return get_object_vars($this);
	}
}
