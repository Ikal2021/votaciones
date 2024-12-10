<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lugarpoblado extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_departamento',
        'id_municipio',
        'id_aldea',
        'id_area',
        'codigo_lugar_poblado',
        'nombre_lugar_poblado'
    ];

    protected $hidden = ['id_departamento', 'id_municipio', 'id_aldea', 'id_area'];

    /**
     * Get the user that owns the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     //Relacion inversa con sus padres
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    public function aldea(): BelongsTo
    {
        return $this->belongsTo(Aldea::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get all of the comments for the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     //Relacion uno a muchos
    public function centro_votacion(): HasMany
    {
        return $this->hasMany(CentroVotacion::class);
    }

    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
}

