<?php

namespace App\DTO\Models;

use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    public string $id;
    public string $title;
    public int $user_id;
    public ?string $description;
    public bool $completed;
    public ?string $created_at;
    public ?string $updated_at;
}
