<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_partido',
         'nombre'
    ];

    protected $hidden = ['id_partido'];

    /**
     * Get the user that owns the Movimiento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partido(): BelongsTo
    {
        return $this->belongsTo(Partido::class);
    }

    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(Personamovimiento::class);
    }
}
