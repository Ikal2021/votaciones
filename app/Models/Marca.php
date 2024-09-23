<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_acta',
        'id_persona_movimiento',
        'cantidad',
    ];

    protected $hidden = ['id_acta', 'id_persona_movimiento'];

    /**
     * Get the user that owns the Marca
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona_movimiento(): BelongsTo
    {
        return $this->belongsTo(PersonasMovimiento::class);
    }

    public function acta(): BelongsTo
    {
        return $this->belongsTo(Acta::class);
    }
}
