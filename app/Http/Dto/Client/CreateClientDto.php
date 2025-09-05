
<?php

namespace App\Http\Dto\Client;

use App\Http\Dto\BaseDto;

class CreateClientDto extends BaseDto
{
    private string $name;
    private string $document;
    private string $phone;
    private string $birth_date;
    private string $address;
    private int $user_id;

    public function __construct(
        string $name,
        string $document,
        string $phone,
        string $birth_date,
        string $address,
        int $user_id
    ) {
        $this->name = $name;
        $this->document = $document;
        $this->phone = $phone;
        $this->birth_date = $birth_date;
        $this->address = $address;
        $this->user_id = $user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
    
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}
