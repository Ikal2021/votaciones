<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aldea extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_municipio',
        'codigo',
        'nombre'
    ];

    protected $hidden = ['id_municipio'];

    /**
     * Get the user that owns the Aldea
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * Get all of the comments for the Aldea
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }
}
