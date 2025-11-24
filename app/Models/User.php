<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que podem ser atribuídos em massa (mass assignment)
     * - 'name' e 'password' serão preenchidos via create/update.
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * Campos ocultos ao serializar o modelo (por exemplo ao transformar em JSON)
     * - Mantém a senha e o remember_token fora das respostas públicas.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     * - 'password' => 'hashed' faz com que atribuições diretas a password
     *   sejam automaticamente hashadas (Recurso disponível no Laravel 10+).
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}