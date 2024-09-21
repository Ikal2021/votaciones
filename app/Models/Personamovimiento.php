<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personamovimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_movimiento',
        'id_tipo_candidato',
        'id_departamento',
        'id_municipio',
        'num_planilla'
    ];

    protected $hidden = [
        'id_persona',
        'id_movimiento',
        'id_tipo_candidato',
        'id_departamento',
        'id_municipio'
    ];

    /**
     * Get the user that owns the Personamovimiento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    public function movimiento(): BelongsTo
    {
        return $this->belongsTo(Movimiento::class);
    }

    public function tipo_candidato(): BelongsTo
    {
        return $this->belongsTo(Tipocandidato::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    /**
     * Get all of the comments for the Personamovimiento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marca(): HasMany
    {
        return $this->hasMany(Marca::class);
    }
}
