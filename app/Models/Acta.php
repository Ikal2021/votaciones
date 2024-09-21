<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Acta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_centro_votacion',
        'votos_nulos',
        'votos_en_blanco',
        'votos_totales',
        'total_votos'
    ];

    protected $hidden = [
        'id_centro_votacion'
    ];

    /**
     * Get the user that owns the Acta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centroVotacion(): BelongsTo
    {
        return $this->belongsTo(centroVotacion::class);
    }

    /**
     * Get all of the comments for the Acta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marca(): HasMany
    {
        return $this->hasMany(Marca::class);
    }
}
