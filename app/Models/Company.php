<?php

namespace App\Models;

use App\Traits\HasOwner;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasUuids, SoftDeletes, HasFactory, HasOwner;

    protected $fillable = [
        'owner_id',
        'fantasy_name',
        'legal_name',
        'document',
        'email',
        'image',
        'phone',
        'primary_color',
        'secondary_color',
        'domain',
        'zip_code',
        'state',
        'neighborhood',
        'city',
        'street',
        'number',
        'description',
        'complement',
        'is_active',
        'user_id_created',
        'user_id_updated',
        'user_id_deleted',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'document',
    ];
}
