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
        'total_votos',
        'total_validos',
        'fecha_acta_procesada'
    ];

    protected $hidden = ['id_centro_votacion'];

    /**
     * Get the user that owns the Acta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centro_votacion(): BelongsTo
    {
        return $this->belongsTo(CentroVotacion::class);
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
