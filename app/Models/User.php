<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'iduser';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'jumlahGagalLogin',
        'waktuKunci',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'waktuKunci' => 'datetime',
            'jumlahGagalLogin' => 'integer',
        ];
    }

    public function getNameAttribute(): string
    {
        return $this->attributes['username'] ?? '';
    }

    public function setNameAttribute(string $value): void
    {
        $this->attributes['username'] = $value;
    }

    public function getRememberToken(): ?string
    {
        return null;
    }

    public function setRememberToken($value): void {}

    public function getRememberTokenName(): string
    {
        return '';
    }
}
