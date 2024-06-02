<?php

namespace App\Traits;

trait ActiveScope
{
    public function scopeActive($query)
    {
        return $query->active();
    }

    public function scopeNotActive($query)
    {
        return $query->where('is_active', 0);
    }
}
