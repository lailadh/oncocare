<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $primaryKey = 'id_patient';

    protected $fillable = [
        'date_naissance',
        'adresse',
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


    public function medecins(): BelongsToMany
{
    return $this->belongsToMany(
        Medecin::class,
        'suivre',
        'id_patient',
        'id_medecin',
        'id_patient',
        'id_medecin'
    );
}
public function suivis(): HasMany
{
    return $this->hasMany(
        Suivi::class,
        'id_patient',
        'id_patient'
    );
}

public function rendezVous(): HasMany
{
    return $this->hasMany(
        RendezVous::class,
        'id_patient',
        'id_patient'
    );
}

}