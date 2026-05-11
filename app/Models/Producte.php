<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'descripcio', 'preu', 'imatge', 'destacat', 'seccio_id', 'stock',
    ];

    protected $casts = [
        'destacat' => 'boolean',
        'preu' => 'decimal:2',
    ];

    public function seccio()
    {
        return $this->belongsTo(Seccio::class);
    }

    public function scopeDestacats($query)
    {
        return $query->where('destacat', true);
    }
}
