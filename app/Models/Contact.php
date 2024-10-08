<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
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


    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function scopeDidNotReplied($query)
    {
        return $query->where('status', 0);
    }
}
