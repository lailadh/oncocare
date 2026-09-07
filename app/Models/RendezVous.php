<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RendezVous extends Model
{
    protected $primaryKey = 'id_rendez_vous';

    protected $fillable = [
        'date_heure',
        'statut',
        'motif',
        'id_patient',
        'id_medecin',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(
            Patient::class,
            'id_patient',
            'id_patient'
        );
    }

    public function medecin(): BelongsTo
    {
        return $this->belongsTo(
            Medecin::class,
            'id_medecin',
            'id_medecin'
        );
    }
}