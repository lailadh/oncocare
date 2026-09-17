<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemandeSuivi extends Model
{
    protected $table = 'demandes_suivi';

    protected $primaryKey = 'id_demande';

    protected $fillable = [
        'statut',
        'date_demande',
        'date_traitement',
        'id_patient',
        'id_medecin',
    ];

    protected $casts = [
        'date_demande' => 'date',
        'date_traitement' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
