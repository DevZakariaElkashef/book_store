<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public function getKeyAttribute()
    {
        return $this->attributes['key_' . app()->getLocale()];
    }

    public function getValueAttribute()
    {
        return $this->attributes['key_' . app()->getLocale()];
    }
}
