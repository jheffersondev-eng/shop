<?php

namespace App\Http\Requests\User;

use App\Http\Dto\User\UserDto;
use App\Http\Dto\UserDetails\UserDetailsDto;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends CommonRulesUserRequest
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
                'password' => ['required', 'confirmed', 'min:6'],
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
            $this->input('credit_limit', 0.0)
        );

        return new UserDto(
            $this->input('email'),
            $this->input('password'),
            $this->input('is_active', true),
            $this->input('profile_id'),
            Auth::id(),
            $userDetailsDto
        );
    }
}