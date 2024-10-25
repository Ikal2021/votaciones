<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CentroVotacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_aldea',
        'codigo_centro',
        'nombre_centro'
    ];

    protected $hidden = ['id_aldea'];

    /**
     * Get the user that owns the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aldea(): BelongsTo
    {
        return $this->belongsTo(Aldea::class);
    }

    /**
     * Get all of the comments for the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }
}
