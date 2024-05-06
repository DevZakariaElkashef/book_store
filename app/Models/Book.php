<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
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

    public function college()
    {
        return $this->belongsTo(College::class);
    }


    public function images()
    {
        return $this->hasMany(BookImage::class);
    }
}
