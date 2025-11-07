<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserDetail;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_id',
        'total',
        'discount',
        'status',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'discount' => 'decimal:2',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(UserDetail::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

