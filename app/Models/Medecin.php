<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Medecin extends Model
{
    protected $primaryKey = 'id_medecin';

    protected $fillable = [
        'specialite',
        'id_utilisateur',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_utilisateur',
            'id'
        );
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(
            Patient::class,
            'suivre',
            'id_medecin',
            'id_patient'
        );
    }

public function rendezVous(): HasMany
{
    return $this->hasMany(
        RendezVous::class,
        'id_medecin',
        'id_medecin'
    );
}

}