<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait HasOwner
 * 
 * Automatically manages owner_id for tenant-aware models.
 * - Fills owner_id when creating new records
 * - Uses Auth::user()->owner_id if user is an employee
 * - Uses Auth::id() if user is root admin (no owner_id)
 */
trait HasOwner
{
    protected static function bootHasOwner()
    {
        static::creating(function ($model) {
            if (!Auth::check()) {
                return;
            }

            // If owner_id is not already set, determine it
            if (empty($model->owner_id)) {
                $model->owner_id = Auth::user()->owner_id ?? Auth::id();
            }
        });
    }
}
