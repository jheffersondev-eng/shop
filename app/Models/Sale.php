<?php

namespace App\Models;

use App\Traits\HasOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserDetail;

class Sale extends Model
{
    use HasFactory, SoftDeletes, HasOwner;

    protected $fillable = [
        'client_id',
        'user_id',
        'total',
        'discount',
        'status',
        'owner_id',
        'user_id_created',
        'user_id_updated',
        'user_id_deleted',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'discount' => 'decimal:2',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}

