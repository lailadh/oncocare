<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutorisationProche extends Model
{
    protected $primaryKey = 'id_autorisation';

    protected $fillable = [
        'acces_suivi',
        'acces_rendez_vous',
        'statut',
        'date_autorisation',
        'id_patient',
        'id_proche',
    ];

    protected $casts = [
        'acces_suivi' => 'boolean',
        'acces_rendez_vous' => 'boolean',
        'date_autorisation' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(
            Patient::class,
            'id_patient',
            'id_patient'
        );
    }

    public function proche(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_proche',
            'id'
        );
    }
}