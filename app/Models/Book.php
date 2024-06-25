<?php

namespace App\Models;

use App\Traits\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
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


    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

    public function getAuthorAttribute()
    {
        return $this->attributes['author_' . app()->getLocale()];
    }

    public function scopeUsed($query)
    {
        return $query->where('is_new', 0);
    }

    public function scopeOffers($query)
    {
        $query->whereNotNull('offer')
            ->whereNotNull('offer_start_at')
            ->whereNotNull('offer_end_at')
            ->whereDate('offer_start_at', '<=', now())  // Changed >= to <=
            ->whereDate('offer_end_at', '>=', now());   // Changed <= to >=
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function images()
    {
        return $this->hasMany(BookImage::class);
    }
}
