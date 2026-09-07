<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medecin extends Model
{
    protected $primaryKey ='id_medecin';
    protected $fillable = ['specialite', 
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
}