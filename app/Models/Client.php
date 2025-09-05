<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'document',
        'birth_date',
        'phone',
        'email',
        'address',
        'credit_limit',
        'status',
    ];

    protected $hidden = [
        'document',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'credit_limit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNameAndSurnameAttribute()
    {
        $names = explode(' ', trim($this->name));
        $first = isset($names[0]) ? ucfirst(strtolower($names[0])) : '';
        $second = isset($names[1]) ? ucfirst(strtolower($names[1])) : '';
        return trim($first . ' ' . $second);
    }
}

