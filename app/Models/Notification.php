<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $primaryKey = 'id_notification';

    protected $fillable = [
        'titre',
        'type',
        'message',
        'lu',
        'date_notification',
        'id_utilisateur',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'date_notification' => 'datetime',
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