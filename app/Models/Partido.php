<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    /**
     * Get all of the comments for the Partido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimiento(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }
}
