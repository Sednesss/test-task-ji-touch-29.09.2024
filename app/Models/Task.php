<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'user_id',
        'description',
        'completed',
    ];

    public function setIdAttribute(string $value)
    {
        $this->attributes['id'] = Uuid::fromString($value)->getBytes();
    }

    public function getIdTextAttribute(): string
    {
        return Uuid::fromBytes($this->id)->toString();
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'char';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
