<?php

namespace App\Models;

use App\Enums\EIsActive;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'is_active',
        'user_id_update',
        'user_id_create',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => EIsActive::class,
        'profile_id' => 'integer',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    // Alias for user details to match view expectations (userDetail)
    public function userDetailAlias()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function userIdUpdate()
    {
        return $this->hasOne(UserDetail::class, 'user_id_update');
    }

    public function userIdCreate()
    {
        return $this->hasOne(UserDetail::class, 'user_id_create');
    }

    /**
     * $fillable: Define quais campos podem ser preenchidos em massa (mass assignment),
     * por exemplo, ao criar ou atualizar um registro usando Model::create($dados).
     * Isso protege contra atribuição de campos não autorizados.
     */

    /**
     * $hidden: Esconde os campos listados ao transformar o model em array ou JSON,
     * útil para não expor informações sensíveis como senha ou tokens em APIs.
     */

    /**
     * $casts: Converte automaticamente os valores dos campos para o tipo especificado
     * ao acessar ou salvar no banco. Exemplo: 'is_active' => 'boolean' faz o campo
     * ser tratado como booleano, 'deleted_at' => 'datetime' como data/hora.
     */
}
