<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suivi extends Model
{
    protected $primaryKey = 'id_suivi';

    protected $fillable = [
        'date_suivi',
        'type_cancer',
        'stade',
        'observation',
        'evolution',
        'traitement',
        'id_patient',
        'id_medecin',
    ];

    protected $casts = [
        'date_suivi' => 'date',
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

