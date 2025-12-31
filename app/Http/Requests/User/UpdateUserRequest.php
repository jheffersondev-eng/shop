<?php

namespace App\Http\Requests\User;

use App\Http\Dto\User\UserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;

class UpdateUserRequest extends CommonRulesUserRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->normalizeInputs();

        return array_merge(
            $this->commonRules(),
            [
                'password' => ['nullable', 'confirmed', 'min:6'],
                'profile_id' => ['required', 'integer'],
                'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            ]
        );
    }

    public function getDto(): UserDto
    {
        $userDetailsDto = new UserDetailsDto(
            $this->input('name'),
            $this->input('document'),
            $this->input('birth_date'),
            $this->input('phone'),
            $this->input('address'),
            $this->input('credit_limit', 0.0),
            $this->file('image', null),
            $this->input('user_id', null)
        );

        return new UserDto(
            $this->input('email'),
            $this->input('password'),
            $this->input('is_active', true),
            $this->input('profile_id'),
            $userDetailsDto,
            $this->input('owner_id', null)
        );
    }
}