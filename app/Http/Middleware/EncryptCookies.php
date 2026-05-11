<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * IMPORTANT: La cookie de la cistella NO es xifra, perquè el projecte
     * exigeix l'ús de $_COOKIE directament (apartat 7). Si fos xifrada,
     * $_COOKIE contindria text encriptat inútil.
     */
    protected $except = [
        'cistella_tenda',
    ];
}
