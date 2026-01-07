<?php

namespace App\Models;

use App\Enums\EIsActive;
use App\Models\UserDetail;
use App\Traits\HasOwner;
use App\Traits\HasPermissionCheck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasOwner, HasPermissionCheck;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'is_active',
        'owner_id',
        'user_id_created',
        'user_id_updated',
        'user_id_deleted',
        'verification_code',
        'verification_expires_at',
        'email_verified_at',
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
        'email_verified_at' => 'datetime',
        'verification_expires_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function userDetailAlias()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function userIdUpdated()
    {
        return $this->hasOne(UserDetail::class, 'user_id_updated');
    }

    public function userIdCreated()
    {
        return $this->hasOne(UserDetail::class, 'user_id_created');
    }

    /**
     * Sobrescreve o método can() do Laravel para suportar permissões customizadas
     * Se a permissão for no formato "ControllerName@method", usa hasPermission()
     * Senão, chama o método pai para usar o sistema padrão do Laravel
     * 
     * @param mixed $abilities
     * @param mixed $arguments
     * @return bool
     */
    public function can($abilities, $arguments = [])
    {
        // Se for uma string simples com @, é uma permissão de ação nossa
        if (is_string($abilities) && strpos($abilities, '@') !== false) {
            return $this->hasPermission($abilities);
        }

        // Senão, chama o método pai (compatível com policies do Laravel)
        return parent::can($abilities, $arguments);
    }
}
