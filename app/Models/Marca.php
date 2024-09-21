<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona_por_movimiento',
        'id_acta',
        'cantidad'
    ];

    protected $hidden = [
        'id_persona_por_movimiento',
        'id_acta'
    ];

    /**
     * Get the user that owns the Marca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acta(): BelongsTo
    {
        return $this->belongsTo(Acta::class);
    }

    public function persona_movimiento(): BelongsTo
    {
        return $this->belongsTo(Personamovimiento::class);
    }
}
