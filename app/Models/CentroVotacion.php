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
        'id_departamento',
        'id_municipio',
        'id_aldea',
        'id_area',
        'id_lugar_poblado',
        'codigo_centro',
        'nombre_centro'
    ];

    protected $hidden = ['id_departamento', 'id_municipio', 'id_aldea', 'id_area',
     'id_lugar_poblado'];

    /**
     * Get the user that owns the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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

    public function lugar_poblado(): BelongsTo
    {
        return $this->belongsTo(Lugarpoblado::class);
    }

    /**
     * Get all of the comments for the CentroVotacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     //Relacion uno a muchos
    public function acta(): HasMany
    {
        return $this->hasMany(Acta::class);
    }
    
    public function marca(): HasMany
    {
        return $this->hasMany(Marca::class);
    }
}

