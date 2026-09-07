<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
            'id_medecin'
        );
    }
}