<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'tipus',
        'nom_complet', 'dni', 'telefon', 'direccio', 'poblacio', 'codi_postal',
        'cif', 'rao_social', 'direccio_fact', 'poblacio_fact', 'codi_postal_fact',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comandes()
    {
        return $this->hasMany(Comanda::class);
    }

    public function esAdmin(): bool
    {
        return $this->tipus === 'admin';
    }

    public function esEmpresa(): bool
    {
        return $this->tipus === 'empresa';
    }
}
