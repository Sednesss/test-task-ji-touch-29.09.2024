<?php

namespace App\DTO\Models;

use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public string $id;
    public string $name;
    public string $email;
    public ?string $email_verified_at;
    public string $password;
    public ?string $created_at;
    public ?string $updated_at;
}
