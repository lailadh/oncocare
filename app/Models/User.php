<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'nom',
    'prenom',
    'email',
    'password',
    'telephone',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function patient(): HasOne
    {
        return $this->hasOne(
            Patient::class,
            'id_utilisateur',
            'id'
        );
    }

    public function medecin(): HasOne
    {
        return $this->hasOne(
            Medecin::class,
            'id_utilisateur',
            'id'
        );
    }

    public function autorisationsProche(): HasMany
    {
        return $this->hasMany(
            AutorisationProche::class,
            'id_proche',
            'id'
        );
    }

    public function notificationsPersonnelles(): HasMany
    {
        return $this->hasMany(
            Notification::class,
            'id_utilisateur',
            'id'
        );
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}