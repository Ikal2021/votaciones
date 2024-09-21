<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipocandidato extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    /**
     * Get all of the comments for the Tipocandidato
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persona_movimiento(): HasMany
    {
        return $this->hasMany(Personamovimiento::class);
    }
}
