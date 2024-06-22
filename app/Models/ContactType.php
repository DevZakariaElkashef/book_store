<?php

namespace App\Models;

use App\Traits\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactType extends Model
{
    use HasFactory, SoftDeletes, ActiveScope;

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


    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
}
